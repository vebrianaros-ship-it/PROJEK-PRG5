<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Sistem Penjadwalan Demo & Sidang</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-graduation-cap"></i> PKTA System
            </a>
            
            <button class="navbar-toggler d-lg-none" type="button" id="sidebarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="navbar-nav ms-auto">
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ auth()->user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span class="dropdown-item-text">Role: {{ ucfirst(auth()->user()->role) }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar-nav bg-dark" id="sidebar">
        <div class="sidebar-header p-3">
            <h5 class="text-white mb-0">
                <i class="fas fa-graduation-cap"></i> PKTA System
            </h5>
        </div>
        <div class="sidebar-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    @auth
                        @if(auth()->user()->isPIC())
                            <!-- Admin Menu -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#datamaster">
                                    <i class="fas fa-database"></i>
                                    <span>Data Master</span>
                                    <i class="fas fa-chevron-down ms-auto"></i>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.mahasiswa.*') || request()->routeIs('admin.dosen.*') || request()->routeIs('admin.kelompok.*') ? 'show' : '' }}" id="datamaster">
                                    <ul class="nav flex-column ms-3">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}" 
                                               href="{{ route('admin.mahasiswa.index') }}">
                                                <i class="fas fa-user-graduate"></i> Mahasiswa
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}" 
                                               href="{{ route('admin.dosen.index') }}">
                                                <i class="fas fa-chalkboard-teacher"></i> Dosen
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('admin.kelompok.*') ? 'active' : '' }}" 
                                               href="{{ route('admin.kelompok.index') }}">
                                                <i class="fas fa-users"></i> Kelompok
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#penjadwalan">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Penjadwalan</span>
                                    <i class="fas fa-chevron-down ms-auto"></i>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.jadwal-demo.*') || request()->routeIs('admin.jadwal-demo-pl.*') || request()->routeIs('admin.jadwal-sidang.*') ? 'show' : '' }}" id="penjadwalan">
                                    <ul class="nav flex-column ms-3">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('admin.jadwal-demo.*') && !request()->routeIs('admin.jadwal-demo-pl.*') ? 'active' : '' }}" 
                                               href="{{ route('admin.jadwal-demo.index') }}">
                                                <i class="fas fa-calendar-check"></i> Demo
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('admin.jadwal-demo-pl.*') ? 'active' : '' }}" 
                                               href="{{ route('admin.jadwal-demo-pl.index') }}">
                                                <i class="fas fa-calendar-plus"></i> Demo PL
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('admin.jadwal-sidang.*') ? 'active' : '' }}" 
                                               href="{{ route('admin.jadwal-sidang.index') }}">
                                                <i class="fas fa-calendar-times"></i> Sidang
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                        @elseif(auth()->user()->isDosen())
                            <!-- Dosen Menu -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}" 
                                   href="{{ route('dosen.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dosen.availability.*') ? 'active' : '' }}" 
                                   href="{{ route('dosen.availability.index') }}">
                                    <i class="fas fa-calendar-plus"></i>
                                    <span>Ketersediaan</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dosen.jadwal.*') ? 'active' : '' }}" 
                                   href="{{ route('dosen.jadwal.index') }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Saya</span>
                                </a>
                            </li>
                            
                        @elseif(auth()->user()->isMahasiswa())
                            <!-- Mahasiswa Menu -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}" 
                                   href="{{ route('mahasiswa.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('mahasiswa.pendaftaran-demo.*') ? 'active' : '' }}" 
                                   href="{{ route('mahasiswa.pendaftaran-demo.index') }}">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pendaftaran Demo</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('mahasiswa.jadwal.*') ? 'active' : '' }}" 
                                   href="{{ route('mahasiswa.jadwal.index') }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Saya</span>
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </nav>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay d-lg-none" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            padding-top: 56px;
        }

        /* Hide scrollbars for all table-responsive containers */
        .table-responsive {
            overflow-x: hidden !important;
        }

        .table-responsive::-webkit-scrollbar {
            display: none;
        }

        .table-responsive {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Ensure tables fit properly */
        .table {
            table-layout: auto;
            width: 100%;
        }

        .table td, .table th {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        /* Allow text wrapping for specific columns */
        .table td:nth-child(2), /* Nama kolom */
        .table td:nth-child(3), /* Anggota/Info kolom */
        .table td:nth-child(4) { /* Pembimbing/Detail kolom */
            white-space: normal;
            word-wrap: break-word;
        }

        .sidebar-nav {
            width: 280px;
            height: calc(100vh - 56px);
            position: fixed;
            top: 56px;
            left: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .sidebar-nav .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 25px;
        }

        .sidebar-nav .nav-link.active {
            color: #fff;
            background-color: #007bff;
            border-left: 4px solid #0056b3;
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .sidebar-nav .nav-link .fas.fa-chevron-down {
            margin-left: auto;
            margin-right: 0;
            transition: transform 0.3s ease;
        }

        .sidebar-nav .nav-link[aria-expanded="true"] .fas.fa-chevron-down {
            transform: rotate(180deg);
        }

        .main-content {
            margin-left: 280px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .alert {
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
        }

        /* Mobile Sidebar */
        @media (max-width: 991px) {
            .sidebar-nav {
                transform: translateX(-100%);
            }

            .sidebar-nav.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .sidebar-overlay.show {
                display: block;
            }

            /* Mobile table adjustments */
            .table td, .table th {
                max-width: 150px;
                font-size: 0.9rem;
            }
        }

        /* Desktop - Always show sidebar */
        @media (min-width: 992px) {
            .navbar-toggler {
                display: none;
            }
        }

        /* Submenu styling */
        .sidebar-nav .collapse .nav-link {
            padding-left: 50px;
            font-size: 0.9rem;
        }

        .sidebar-nav .collapse .nav-link:hover {
            padding-left: 55px;
        }

        .sidebar-nav .collapse .nav-link.active {
            background-color: rgba(0, 123, 255, 0.3);
            border-left: 4px solid #007bff;
        }

        /* Smooth animations */
        .collapse {
            transition: all 0.3s ease;
        }

        /* User dropdown styling */
        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .dropdown-item {
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            padding-left: 20px;
        }
    </style>

    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const toggleButton = document.getElementById('sidebarToggle');

            // Toggle sidebar on mobile
            if (toggleButton) {
                toggleButton.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    if (sidebarOverlay) {
                        sidebarOverlay.classList.toggle('show');
                    }
                });
            }

            // Close sidebar when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }

            // Handle submenu collapse
            const collapseElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
            collapseElements.forEach(element => {
                element.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('data-bs-target'));
                    if (target) {
                        const collapse = new bootstrap.Collapse(target, {
                            toggle: true
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>