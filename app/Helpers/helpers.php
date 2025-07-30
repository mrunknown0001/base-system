<?php

if(!function_exists(decryptString)) {
    function decryptString($id) {
        try {
            $id = Crypt::decryptString($id);
        }
        catch (\Throwable $e) {
            return abort(500);
        }

        return $id;
    }
}