<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Politeknik Astra</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/favicon.ico">
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
            overflow-y: hidden;
        }

        /* Hide scrollbar for all browsers */
        ::-webkit-scrollbar {
            display: none;
        }

        html {
            -ms-overflow-style: none;
            scrollbar-width: none;
            overflow: hidden;
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

        .nav-item:hover, .nav-item.active {
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

        .about-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 60px 40px;
            width: 100%;
            max-width: 800px;
            position: relative;
            z-index: 1;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .astra-logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .astra-favicon-logo {
            width: 100px;
            height: auto;
            filter: drop-shadow(0 8px 25px rgba(30, 60, 114, 0.3));
            transition: transform 0.3s ease;
        }

        .astra-favicon-logo:hover {
            transform: scale(1.05);
        }

        .page-title {
            color: #1e3c72;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .page-subtitle {
            color: #666;
            font-size: 18px;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .section-title {
            color: #1e3c72;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
            border-left: 4px solid #2a5298;
            padding-left: 15px;
        }

        .section-content {
            color: #495057;
            font-size: 16px;
            line-height: 1.6;
            text-align: justify;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .stat-item {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            border-left: 5px solid #2a5298;
        }

        .stat-number {
            color: #1e3c72;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
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
            
            .about-container {
                margin: 20px;
                padding: 40px 25px;
            }
            
            .page-title {
                font-size: 28px;
            }
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
                <a href="{{ url('/') }}" class="nav-item">Home</a>
                <a href="{{ url('/about') }}" class="nav-item active">About</a>
                <a href="{{ url('/services') }}" class="nav-item">Services</a>
                <a href="{{ url('/contact') }}" class="nav-item">Contact</a>
                <a href="{{ route('login') }}" class="nav-item login-btn">Login</a>
            </nav>
            <button class="mobile-menu-toggle" id="mobileToggle">☰</button>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="about-container">
            <div class="logo-section">
                <div class="astra-logo-container">
                    <img src="/assets/favicon.ico" alt="Astra Logo" class="astra-favicon-logo">
                </div>
            </div>

            <h1 class="page-title">Tentang Politeknik Astra</h1>
            <p class="page-subtitle">
                Institusi pendidikan tinggi terkemuka yang berkomitmen menghasilkan lulusan berkualitas dengan teknologi terdepan dan pembelajaran yang inovatif.
            </p>

            <div class="content-section">
                <h2 class="section-title">Visi</h2>
                <p class="section-content">
                    Menjadi politeknik terdepan di Indonesia yang menghasilkan lulusan berkarakter, kompeten, dan siap kerja dalam bidang teknologi dan industri otomotif.
                </p>
            </div>

            <div class="content-section">
                <h2 class="section-title">Misi</h2>
                <p class="section-content">
                    Menyelenggarakan pendidikan vokasi berkualitas tinggi, mengembangkan penelitian terapan yang bermanfaat bagi industri, dan memberikan layanan kepada masyarakat melalui pengabdian yang berkelanjutan.
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">25+</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">5000+</div>
                    <div class="stat-label">Alumni</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Dosen Ahli</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Program Studi</div>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Keunggulan</h2>
                <p class="section-content">
                    Politeknik Astra memiliki fasilitas laboratorium modern, kerjasama industri yang kuat, kurikulum yang selalu update sesuai kebutuhan industri, dan tenaga pengajar yang berpengalaman di bidangnya masing-masing.
                </p>
            </div>
        </div>
    </div>

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