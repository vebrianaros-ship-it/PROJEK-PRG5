<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Politeknik Astra</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: 
                linear-gradient(135deg, rgba(30, 60, 114, 0.6) 0%, rgba(42, 82, 152, 0.6) 100%),
                url('/assets/BackgroundLoginAstra.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* Header Navigation */
        .header-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(30, 60, 114, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-logo img {
            width: 50px;
            height: auto;
            filter: brightness(0) invert(1);
        }

        .nav-logo-text {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .nav-item {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-item.login-btn {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .nav-item.login-btn:hover {
            background: white;
            color: #1e3c72;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 100px;
        }

        /* Background pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255,255,255,0.05) 0%, transparent 50%);
            opacity: 0.3;
        }

        .welcome-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 60px 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .logo-section {
            margin-bottom: 40px;
        }

        .astra-logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .astra-favicon-logo {
            width: 150px;
            height: auto;
            filter: drop-shadow(0 8px 25px rgba(30, 60, 114, 0.3));
            transition: transform 0.3s ease;
        }

        .astra-favicon-logo:hover {
            transform: scale(1.05);
        }

        .welcome-title {
            color: #1e3c72;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .welcome-subtitle {
            color: #666;
            font-size: 18px;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .institution-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 40px;
            border-left: 5px solid #2a5298;
        }

        .institution-name {
            color: #1e3c72;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .institution-description {
            color: #495057;
            font-size: 16px;
            line-height: 1.5;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            min-width: 140px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(30, 60, 114, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #2a5298;
            border: 2px solid #2a5298;
        }

        .btn-secondary:hover {
            background: #2a5298;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(42, 82, 152, 0.2);
        }

        .features {
            margin-top: 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .feature-item {
            background: rgba(42, 82, 152, 0.1);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .feature-icon {
            font-size: 24px;
            margin-bottom: 10px;
            color: #2a5298;
        }

        .feature-text {
            color: #495057;
            font-size: 14px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .nav-container {
                padding: 0 20px;
            }
            
            .nav-logo-text {
                font-size: 20px;
            }
            
            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(30, 60, 114, 0.98);
                flex-direction: column;
                gap: 0;
                padding: 20px;
            }
            
            .nav-menu.active {
                display: flex;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .nav-item {
                font-size: 16px;
                padding: 15px 20px;
                width: 100%;
                text-align: center;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            
            .nav-item:last-child {
                border-bottom: none;
            }
            
            .welcome-container {
                margin: 20px;
                padding: 40px 25px;
            }
            
            .welcome-title {
                font-size: 28px;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 250px;
            }
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 10%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .user-info {
            background: linear-gradient(135deg, #e8f5e8, #d4edda);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 5px solid #28a745;
        }

        .user-welcome {
            color: #155724;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .user-details {
            color: #495057;
            font-size: 14px;
        }

        .logout-form {
            display: inline;
        }

        .btn-logout {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header class="header-nav">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="/assets/favicon.ico" alt="Astra Logo">
                <span class="nav-logo-text">ASTRA</span>
            </div>
            <nav class="nav-menu" id="navMenu">
                <a href="#home" class="nav-item">Home</a>
                <a href="#about" class="nav-item">About</a>
                <a href="#services" class="nav-item">Services</a>
                <a href="#contact" class="nav-item">Contact</a>
                <a href="{{ route('login') }}" class="nav-item login-btn">Login</a>
            </nav>
            <button class="mobile-menu-toggle" id="mobileToggle">☰</button>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>

    <div class="welcome-container">
        <div class="logo-section">
            <!-- Astra Logo from favicon.ico -->
            <div class="astra-logo-container">
                <img src="/assets/favicon.ico" alt="Astra Logo" class="astra-favicon-logo">
            </div>
        </div>

        <h1 class="welcome-title">Selamat Datang di Aplikasi Kami</h1>
        <p class="welcome-subtitle">
            Sistem Informasi Akademik Politeknik Astra<br>
            Platform digital untuk mendukung kegiatan akademik dan administrasi
        </p>

        @auth
            <div class="user-info">
                <div class="user-welcome">Selamat datang, {{ Auth::user()->name }}!</div>
                <div class="user-details">
                    Username: {{ Auth::user()->username }}<br>
                    Email: {{ Auth::user()->email }}
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        @else
            <div class="institution-info">
                <div class="institution-name">POLITEKNIK ASTRA</div>
                <div class="institution-description">
                    Institusi pendidikan tinggi yang berkomitmen menghasilkan lulusan berkualitas 
                    dengan teknologi terdepan dan pembelajaran yang inovatif.
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar</a>
            </div>
        @endauth

        <div class="features">
            <div class="feature-item">
                <div class="feature-icon">🎓</div>
                <div class="feature-text">Sistem Akademik</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">📚</div>
                <div class="feature-text">E-Learning</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">💼</div>
                <div class="feature-text">Portal Mahasiswa</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">📊</div>
                <div class="feature-text">Laporan Akademik</div>
            </div>
        </div>
    </div>
    </div> <!-- Close main-content -->

    <script>
        // Mobile menu toggle
        document.getElementById('mobileToggle').addEventListener('click', function() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking on a nav item
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', () => {
                document.getElementById('navMenu').classList.remove('active');
            });
        });
    </script>
</body>
</html>