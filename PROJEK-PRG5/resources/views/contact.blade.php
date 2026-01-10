<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Politeknik Astra</title>
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

        .contact-container {
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

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .contact-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            border-left: 5px solid #2a5298;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(30, 60, 114, 0.2);
        }

        .contact-icon {
            font-size: 48px;
            margin-bottom: 20px;
            color: #2a5298;
        }

        .contact-title {
            color: #1e3c72;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .contact-info {
            color: #495057;
            font-size: 16px;
            line-height: 1.6;
        }

        .contact-form {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 15px;
            padding: 40px;
            margin-top: 30px;
            border-left: 5px solid #2196f3;
        }

        .form-title {
            color: #1565c0;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: #1565c0;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e3f2fd;
            border-radius: 8px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #2196f3;
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #2196f3, #1976d2);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(33, 150, 243, 0.3);
        }

        .map-section {
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            border-left: 5px solid #9c27b0;
            text-align: center;
        }

        .map-title {
            color: #7b1fa2;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .map-info {
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
            
            .contact-container {
                margin: 20px;
                padding: 40px 25px;
            }
            
            .page-title {
                font-size: 28px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .contact-form {
                padding: 30px 20px;
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
                <a href="{{ url('/services') }}" class="nav-item">Services</a>
                <a href="{{ url('/contact') }}" class="nav-item active">Contact</a>
                <a href="{{ route('login') }}" class="nav-item login-btn">Login</a>
            </nav>
            <button class="mobile-menu-toggle" id="mobileToggle">☰</button>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="contact-container">
            <div class="logo-section">
                <div class="astra-logo-container">
                    <img src="/assets/favicon.ico" alt="Astra Logo" class="astra-favicon-logo">
                </div>
            </div>

            <h1 class="page-title">Hubungi Kami</h1>
            <p class="page-subtitle">
                Kami siap membantu Anda dengan informasi lebih lanjut tentang program studi, pendaftaran, dan layanan Politeknik Astra.
            </p>

            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">📍</div>
                    <h3 class="contact-title">Alamat</h3>
                    <div class="contact-info">
                        Jl. Gaya Motor Raya No. 8<br>
                        Sunter II, Jakarta Utara<br>
                        DKI Jakarta 14330
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">📞</div>
                    <h3 class="contact-title">Telepon</h3>
                    <div class="contact-info">
                        (021) 6519555<br>
                        (021) 6519777<br>
                        Fax: (021) 6519666
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">✉️</div>
                    <h3 class="contact-title">Email</h3>
                    <div class="contact-info">
                        info@politeknikastra.ac.id<br>
                        admisi@politeknikastra.ac.id<br>
                        akademik@politeknikastra.ac.id
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">🕒</div>
                    <h3 class="contact-title">Jam Operasional</h3>
                    <div class="contact-info">
                        Senin - Jumat: 08:00 - 17:00<br>
                        Sabtu: 08:00 - 12:00<br>
                        Minggu: Tutup
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h3 class="form-title">Kirim Pesan</h3>
                <form action="#" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" id="subject" name="subject" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea id="message" name="message" class="form-textarea" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Kirim Pesan</button>
                </form>
            </div>

            <div class="map-section">
                <h3 class="map-title">Lokasi Kampus</h3>
                <p class="map-info">
                    Politeknik Astra berlokasi strategis di Jakarta Utara, mudah diakses dengan transportasi umum maupun kendaraan pribadi. 
                    Kampus kami dilengkapi dengan fasilitas modern dan lingkungan belajar yang kondusif.
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