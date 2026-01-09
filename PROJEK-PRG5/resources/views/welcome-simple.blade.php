<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel with Breeze</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .nav {
            text-align: right;
            margin-bottom: 20px;
        }
        .nav a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 5px;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav a:hover {
            background-color: #2563eb;
        }
        .content {
            text-align: center;
            padding: 40px 0;
        }
        h1 {
            color: #1f2937;
            margin-bottom: 20px;
        }
        p {
            color: #6b7280;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        @if (Route::has('login'))
            <div class="nav">
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: #ef4444; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="header">
            <h1>🎉 Laravel Breeze Authentication</h1>
            <p>Authentication system berhasil diinstall!</p>
        </div>

        <div class="content">
            @auth
                <h2>Selamat datang, {{ Auth::user()->name }}!</h2>
                <p>Anda sudah berhasil login ke sistem.</p>
                <p><a href="{{ route('dashboard') }}" style="color: #3b82f6;">Pergi ke Dashboard</a></p>
            @else
                <h2>Silakan Login atau Register</h2>
                <p>Sistem authentication Laravel Breeze sudah siap digunakan.</p>
                <p>Klik tombol Login atau Register di atas untuk memulai.</p>
                
                <div style="margin-top: 30px; padding: 20px; background-color: #f0f9ff; border-radius: 5px;">
                    <h3>Test Account:</h3>
                    <p><strong>Email:</strong> test@example.com</p>
                    <p><strong>Password:</strong> password</p>
                </div>
            @endauth
        </div>
    </div>
</body>
</html>