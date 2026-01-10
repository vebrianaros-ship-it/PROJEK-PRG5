<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Politeknik Astra</title>
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
            overflow-y: auto;
        }

        /* Hide scrollbar for all browsers */
        ::-webkit-scrollbar {
            display: none;
        }

        html {
            -ms-overflow-style: none;
            scrollbar-width: none;
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
            padding: 120px 20px 40px;
        }

        .services-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 60px 40px;
            width: 100%;
            max-width: 1000px;
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

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .service-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            border-left: 5px solid #2a5298;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(30, 60, 114, 0.2);
        }

        .service-icon {
            font-size: 48px;
            margin-bottom: 20px;
            color: #2a5298;
        }

        .service-title {
            color: #1e3c72;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .service-description {
            color: #495057;
            font-size: 14px;
            line-height: 1.6;
        }

        .additional-info {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            border-left: 5px solid #2196f3;
        }

        .info-title {
            color: #1565c0;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .info-content {
            color: #424242;
            font-size: 16px;
            line-height: 1.6;
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
            
            .services-container {
                margin: 20px;
                padding: 40px 25px;
            }
            
            .page-title {
                font-size: 28px;
            }

            .services-grid {
                grid-template-columns: 1fr;
                gap: 20px;
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
                <a href="{{ url('/about') }}" class="nav-item">About</a>
                <a href="{{ url('/services') }}" class="nav-item active">Services</a>
                <a href="{{ url('/contact') }}" class="nav-item">Contact</a>
                <a href="{{ route('login') }}" class="nav-item login-btn">Login</a>
            </nav>
            <button class="mobile-menu-toggle" id="mobileToggle">☰</button>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="services-container">
            <div class="logo-section">
                <div class="astra-logo-container">
                    <img src="/assets/favicon.ico" alt="Astra Logo" class="astra-favicon-logo">
                </div>
            </div>

            <h1 class="page-title">Layanan Kami</h1>
            <p class="page-subtitle">
                Politeknik Astra menyediakan berbagai layanan pendidikan dan fasilitas terbaik untuk mendukung pengembangan kompetensi mahasiswa.
            </p>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🎓</div>
                    <h3 class="service-title">Pendidikan Vokasi</h3>
                    <p class="service-description">
                        Program pendidikan diploma yang fokus pada praktik dan keterampilan industri dengan kurikulum yang selalu update sesuai kebutuhan dunia kerja.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">🔬</div>
                    <h3 class="service-title">Laboratorium Modern</h3>
                    <p class="service-description">
                        Fasilitas laboratorium lengkap dengan peralatan modern untuk mendukung pembelajaran praktis di berbagai bidang teknologi otomotif.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">🏭</div>
                    <h3 class="service-title">Kerjasama Industri</h3>
                    <p class="service-description">
                        Program magang dan kerjasama dengan berbagai perusahaan industri untuk memberikan pengalaman kerja nyata kepada mahasiswa.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">📚</div>
                    <h3 class="service-title">Perpustakaan Digital</h3>
                    <p class="service-description">
                        Akses ke ribuan buku digital, jurnal ilmiah, dan sumber belajar online untuk mendukung kegiatan akademik mahasiswa.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">💼</div>
                    <h3 class="service-title">Career Center</h3>
                    <p class="service-description">
                        Layanan konseling karir, pelatihan soft skills, dan bantuan penempatan kerja untuk mempersiapkan mahasiswa memasuki dunia kerja.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">🌐</div>
                    <h3 class="service-title">E-Learning Platform</h3>
                    <p class="service-description">
                        Platform pembelajaran online yang memungkinkan akses materi kuliah, tugas, dan interaksi dengan dosen kapan saja dan dimana saja.
                    </p>
                </div>
            </div>

            <div class="additional-info">
                <h3 class="info-title">Komitmen Kualitas</h3>
                <p class="info-content">
                    Semua layanan kami dirancang dengan standar kualitas tinggi dan terus dievaluasi untuk memastikan kepuasan dan kesuksesan mahasiswa. 
                    Kami berkomitmen untuk memberikan pengalaman pendidikan terbaik yang mempersiapkan lulusan menjadi tenaga kerja yang kompeten dan siap bersaing di era industri 4.0.0
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