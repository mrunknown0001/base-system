<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect()->route('dash');
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {
        try {
            $base_uri = config('services.auth_api.base_uri');
            $api_key = config('services.auth_api.api_key');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $api_key,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($base_uri . '/api/auth/login', [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            if($response->successful()) {
                
                $response = $response->json();
                $token = $response['token'] ?? null;
                $token_expires = $response['expires_at'] ?? null;
                $email = $response['email'] ?? null;

                // Additional logic to handle the token, e.g., store it in session or cookie
                // check id if exist
                session(['auth_token' => $token, 'token_expires' => $token_expires, 'email' => $email]);

                // Get ID using email
                $query_id = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $api_key,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->post($base_uri . "/users/get-user-id", [
                    'email' => $request->input('email'),
                ]);

                Log::debug($query_id);

                // Validate User using ID if has an access to the System
                try {
                    Auth::loginUsingId($query_id['id']);
                }
                catch(\Throwable $e) {
                    return abort(500);
                }

                // redirect or return a message
                return response()->json([
                    'success' => true,
                    'message' => 'Authentication successful',
                ], 200);
            }
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'Authentication failed: ' . $response->json()['message'] ?? 'Unknown error',
                ], $response->status());
            }
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication failed: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function logout()
    {
        if(Auth::check()) {
	    	Auth::logout();
        }
    	return view('logout');
    }
}
