<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Terminal - Cyber Interface</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-cyan: #00ffff;
            --primary-purple: #8b5cf6;
            --primary-pink: #ff006e;
            --primary-blue: #0066ff;
            --dark-bg: #0a0a0a;
            --darker-bg: #050505;
            --card-bg: rgba(10, 10, 10, 0.8);
            --border-glow: rgba(0, 255, 255, 0.3);
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --success-green: #00ff88;
            --warning-orange: #ff8800;
            --danger-red: #ff0000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: var(--darker-bg);
            color: var(--text-primary);
            overflow-x: hidden;
            min-height: 100vh;
            position: relative;
        }

        /* Animated Background */
        .cyber-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: 
                radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(0, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255, 0, 110, 0.1) 0%, transparent 50%),
                linear-gradient(135deg, var(--darker-bg) 0%, var(--dark-bg) 100%);
        }

        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        /* Floating particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--primary-cyan);
            border-radius: 50%;
            animation: float 15s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .login-terminal {
            background: var(--card-bg);
            border: 2px solid var(--primary-cyan);
            border-radius: 0;
            box-shadow: 
                0 0 30px rgba(0, 255, 255, 0.3),
                inset 0 0 30px rgba(0, 255, 255, 0.05);
            width: 100%;
            max-width: 450px;
            position: relative;
            animation: terminalBoot 1.5s ease-out;
            backdrop-filter: blur(10px);
        }

        @keyframes terminalBoot {
            0% {
                opacity: 0;
                transform: scale(0.8) rotateX(10deg);
                box-shadow: 0 0 0 rgba(0, 255, 255, 0);
            }
            50% {
                opacity: 0.5;
                transform: scale(0.9) rotateX(5deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotateX(0deg);
                box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
            }
        }

        .terminal-header {
            background: linear-gradient(135deg, var(--primary-cyan) 0%, var(--primary-blue) 100%);
            color: var(--darker-bg);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            position: relative;
            overflow: hidden;
        }

        .terminal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: headerScan 3s ease-in-out infinite;
        }

        @keyframes headerScan {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .terminal-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }

        .terminal-controls {
            display: flex;
            gap: 8px;
        }

        .control-btn {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--warning-orange);
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        .control-btn.close { background: var(--primary-pink); }
        .control-btn.minimize { background: var(--warning-orange); }
        .control-btn.maximize { background: var(--success-green); }

        .terminal-body {
            padding: 40px 30px;
            background: var(--card-bg);
        }

        .access-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .access-info h2 {
            font-family: 'Orbitron', monospace;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--primary-cyan);
            margin-bottom: 10px;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            from { text-shadow: 0 0 10px rgba(0, 255, 255, 0.5); }
            to { text-shadow: 0 0 20px rgba(0, 255, 255, 0.8); }
        }

        .access-info p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 300;
        }

        .cyber-form {
            position: relative;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .cyber-input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(0, 255, 255, 0.3);
            border-radius: 0;
            color: var(--text-primary);
            font-size: 1rem;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 500;
            transition: all 0.3s ease;
            outline: none;
        }

        .cyber-input:focus {
            border-color: var(--primary-cyan);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            background: rgba(0, 0, 0, 0.7);
        }

        .cyber-input::placeholder {
            color: rgba(160, 160, 160, 0.7);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-cyan);
            font-size: 1.1rem;
        }

        .cyber-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-cyan) 0%, var(--primary-blue) 100%);
            border: none;
            border-radius: 0;
            color: var(--darker-bg);
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .cyber-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .cyber-button:hover::before {
            left: 100%;
        }

        .cyber-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
        }

        .cyber-button:active {
            transform: translateY(0);
        }

        .biometric-section {
            margin: 30px 0;
            text-align: center;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-cyan), transparent);
        }

        .divider span {
            padding: 0 15px;
            font-family: 'Orbitron', monospace;
        }

        .biometric-options {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .bio-btn {
            width: 60px;
            height: 60px;
            border: 2px solid var(--primary-cyan);
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-cyan);
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .bio-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(0, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }

        .bio-btn:hover::before {
            width: 100%;
            height: 100%;
        }

        .bio-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .cyber-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid var(--primary-cyan);
            background: transparent;
            border-radius: 0;
            position: relative;
            cursor: pointer;
        }

        .cyber-checkbox:checked {
            background: var(--primary-cyan);
        }

        .cyber-checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--darker-bg);
            font-size: 12px;
            font-weight: bold;
        }

        .status-line {
            margin-top: 20px;
            text-align: center;
            font-family: 'Orbitron', monospace;
            font-size: 0.8rem;
            color: var(--success-green);
        }

        .forgot-link {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-link a {
            color: var(--primary-cyan);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .forgot-link a:hover {
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.8);
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-terminal {
                margin: 10px;
                max-width: none;
            }
            
            .terminal-body {
                padding: 30px 20px;
            }
            
            .biometric-options {
                gap: 15px;
            }
            
            .bio-btn {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }

        /* Loading animation */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(0, 255, 255, 0.3);
            border-top: 3px solid var(--primary-cyan);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="cyber-bg"></div>
    <div class="grid-overlay"></div>
    <div class="particles" id="particles"></div>

    <div class="login-container">
        <div class="login-terminal">
            <div class="loading-overlay" id="loadingOverlay">
                <div class="loading-spinner"></div>
            </div>
            
            <div class="terminal-header">
                <div class="terminal-title">
                    <i class="fas fa-terminal"></i>
                    <span>SECURE ACCESS TERMINAL</span>
                </div>
                <div class="terminal-controls">
                    <div class="control-btn close"></div>
                    <div class="control-btn minimize"></div>
                    <div class="control-btn maximize"></div>
                </div>
            </div>
            
            <div class="terminal-body">
                <div class="access-info">
                    <h2>ACCESS REQUIRED</h2>
                    <p>Enter your credentials to access the neural network</p>
                </div>
                
                <form class="cyber-form" id="cyberForm" action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" class="cyber-input" id="email" name="email" placeholder="EMAIL" required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" class="cyber-input" id="password" name="password" placeholder="ACCESS CODE" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                    
                    <div class="checkbox-container">
                        <input type="checkbox" class="cyber-checkbox" name="remember_me" id="rememberMe">
                        <label for="rememberMe">MAINTAIN SESSION</label>
                    </div>
                    
                    <button type="submit" class="cyber-button">
                        <span>INITIATE ACCESS</span>
                    </button>
                </form>
                
                <div class="status-line">
                    <span id="statusText">SYSTEM READY</span>
                </div>
                
                <div class="forgot-link">
                    <a href="#" id="forgotPassword">RECOVER ACCESS</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // documen loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Create floating particles
            createParticles();
        })

        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Form submission
        document.getElementById('cyberForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const statusText = document.getElementById('statusText');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            if (!email || !password) {
                statusText.textContent = 'ACCESS DENIED - INCOMPLETE CREDENTIALS';
                statusText.style.color = 'var(--primary-pink)';
                return;
            }
            
            // Show loading
            loadingOverlay.style.display = 'flex';
            statusText.textContent = 'VALIDATING CREDENTIALS...';
            statusText.style.color = 'var(--warning-orange)';
            
            // Simulate authentication
            setTimeout(() => {
                loadingOverlay.style.display = 'none';

                // submit using AJAX
                const formData = new FormData(this);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', this.action);
                xhr.send(formData);

                xhr.onload = () => {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            statusText.textContent = 'ACCESS GRANTED - WELCOME TO THE SYSTEM';
                            statusText.style.color = 'var(--success-green)';
                            // redirect
                            window.location.href = '/'; // Adjust the redirect URL as needed

                        } else {
                            statusText.textContent = 'ACCESS DENIED - ' + response.message;
                            statusText.style.color = 'var(--danger-red)';
                        }
                    } 
                    else if (xhr.status === 500) {
                        statusText.textContent = 'ACCESS DENIED - SERVER ERROR';
                        statusText.style.color = 'var(--danger-red)';
                    }
                    else {
                        statusText.textContent = 'ACCESS DENIED - NETWORK ERROR';
                        statusText.style.color = 'var(--danger-red)';
                    }
                };
                xhr.onerror = () => {
                    statusText.textContent = 'ACCESS DENIED - NETWORK ERROR';
                    statusText.style.color = 'var(--danger-red)';
                };

            }, 1000);
        });

        // Terminal boot sequence
        window.addEventListener('load', function() {
            const statusText = document.getElementById('statusText');
            const messages = [
                'INITIALIZING NEURAL NETWORK...',
                'LOADING SECURITY PROTOCOLS...',
                'ESTABLISHING ENCRYPTED CONNECTION...',
                'SYSTEM READY'
            ];
            
            let index = 0;
            const interval = setInterval(() => {
                statusText.textContent = messages[index];
                index++;
                
                if (index >= messages.length) {
                    clearInterval(interval);
                    statusText.style.color = 'var(--success-green)';
                }
            }, 800);
        });
    </script>
</body>
</html>