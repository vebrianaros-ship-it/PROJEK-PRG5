<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Politeknik Astra</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .institution-name {
            color: #1e3c72;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .institution-subtitle {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #2a5298;
            background: white;
            box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
        }

        .captcha-container {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .captcha-image {
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .captcha-image:hover {
            border-color: #2a5298;
        }

        .captcha-input {
            flex: 1;
        }

        .refresh-captcha {
            background: #2a5298;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            transition: background 0.3s ease;
        }

        .refresh-captcha:hover {
            background: #1e3c72;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #2a5298;
        }

        .remember-me label {
            color: #666;
            font-size: 14px;
            cursor: pointer;
        }

        .login-button {
            width: 100%;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(30, 60, 114, 0.3);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #2a5298;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #1e3c72;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            border-left: 4px solid #c33;
        }

        .success-message {
            background: #efe;
            color: #363;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            border-left: 4px solid #363;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo">PA</div>
            <div class="institution-name">POLITEKNIK ASTRA</div>
            <div class="institution-subtitle">Sistem Informasi Akademik</div>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input id="username" class="form-input" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" placeholder="Masukkan username Anda">
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Captcha -->
            <div class="form-group">
                <label for="captcha" class="form-label">Kode Captcha</label>
                <div class="captcha-container">
                    <img src="{{ route('captcha') }}" alt="Captcha" class="captcha-image" id="captcha-image" onclick="refreshCaptcha()">
                    <input id="captcha" class="form-input captcha-input" type="text" name="captcha" required placeholder="Masukkan kode captcha" maxlength="5">
                    <button type="button" class="refresh-captcha" onclick="refreshCaptcha()">↻</button>
                </div>
                @error('captcha')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ingat saya</label>
            </div>

            <button type="submit" class="login-button">
                Masuk
            </button>

            <div class="register-link">
                <a href="{{ route('register') }}">Belum punya akun? Daftar di sini</a>
            </div>
        </form>
    </div>

    <script>
        function refreshCaptcha() {
            const img = document.getElementById('captcha-image');
            const timestamp = new Date().getTime();
            img.src = '{{ route('captcha') }}?' + timestamp;
            document.getElementById('captcha').value = '';
            console.log('Captcha refreshed at: ' + timestamp);
        }

        // Auto refresh captcha on page load
        window.onload = function() {
            console.log('Page loaded, refreshing captcha...');
            refreshCaptcha();
        };

        // Add error handling for captcha image
        document.addEventListener('DOMContentLoaded', function() {
            const captchaImg = document.getElementById('captcha-image');
            captchaImg.onerror = function() {
                console.error('Captcha image failed to load');
                this.style.backgroundColor = '#ffcccc';
                this.alt = 'Captcha failed to load';
            };
            captchaImg.onload = function() {
                console.log('Captcha image loaded successfully');
            };
        });
    </script>
</body>
</html>