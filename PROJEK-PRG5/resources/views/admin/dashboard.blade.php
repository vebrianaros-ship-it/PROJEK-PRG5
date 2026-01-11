@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-tachometer-alt text-primary"></i> Admin Dashboard - PIC PKTA</h2>
                    <p class="text-muted mb-0">Kelola sistem penjadwalan Demo PL dan Sidang Akhir</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Tambah Mahasiswa
                    </a>
                    <a href="{{ route('admin.kelompok.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-users"></i> Buat Kelompok
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-gradient-primary text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $stats['total_mahasiswa'] }}</h3>
                            <p class="mb-0">Total Mahasiswa</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-success text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-chalkboard-teacher fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $stats['total_dosen'] }}</h3>
                            <p class="mb-0">Total Dosen</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-info text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-user-friends fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $stats['total_kelompok'] }}</h3>
                            <p class="mb-0">Total Kelompok</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-warning text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $stats['jadwal_demo_pending'] + $stats['jadwal_sidang_pending'] }}</h3>
                            <p class="mb-0">Jadwal Pending</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Cards -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-database text-primary"></i> Data Master</h5>
                        </div>
                        <div class="card-body">
                            <div class="action-cards">
                                <a href="{{ route('admin.mahasiswa.index') }}" class="action-card">
                                    <div class="action-icon bg-primary">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>Kelola Mahasiswa</h6>
                                        <p class="text-muted mb-0">Manajemen data mahasiswa dan NIM</p>
                                    </div>
                                    <div class="action-badge">
                                        <span class="badge bg-primary">{{ $stats['total_mahasiswa'] }}</span>
                                    </div>
                                </a>
                                
                                <a href="{{ route('admin.dosen.index') }}" class="action-card">
                                    <div class="action-icon bg-success">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>Kelola Dosen</h6>
                                        <p class="text-muted mb-0">Manajemen data dosen dan NIP</p>
                                    </div>
                                    <div class="action-badge">
                                        <span class="badge bg-success">{{ $stats['total_dosen'] }}</span>
                                    </div>
                                </a>
                                
                                <a href="{{ route('admin.kelompok.index') }}" class="action-card">
                                    <div class="action-icon bg-info">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>Kelola Kelompok</h6>
                                        <p class="text-muted mb-0">Manajemen kelompok dan anggota</p>
                                    </div>
                                    <div class="action-badge">
                                        <span class="badge bg-info">{{ $stats['total_kelompok'] }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt text-success"></i> Penjadwalan</h5>
                        </div>
                        <div class="card-body">
                            <div class="action-cards">
                                <a href="{{ route('admin.jadwal-demo.index') }}" class="action-card">
                                    <div class="action-icon bg-warning">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>Jadwal Demo PL</h6>
                                        <p class="text-muted mb-0">Penjadwalan Demo Proyek Lanjut</p>
                                    </div>
                                    <div class="action-badge">
                                        <span class="badge bg-warning">{{ $stats['jadwal_demo_pending'] }}</span>
                                    </div>
                                </a>
                                
                                <a href="{{ route('admin.jadwal-sidang.index') }}" class="action-card">
                                    <div class="action-icon bg-danger">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>Jadwal Sidang</h6>
                                        <p class="text-muted mb-0">Penjadwalan Sidang Akhir</p>
                                    </div>
                                    <div class="action-badge">
                                        <span class="badge bg-danger">{{ $stats['jadwal_sidang_pending'] }}</span>
                                    </div>
                                </a>
                                
                                <div class="schedule-summary">
                                    <div class="schedule-item">
                                        <div class="schedule-icon bg-info">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div class="schedule-content">
                                            <span class="schedule-label">Total Jadwal</span>
                                            <span class="schedule-count">{{ $stats['jadwal_demo_pending'] + $stats['jadwal_sidang_pending'] }} pending</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Dashboard Styles */
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
}

.stats-card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 15px;
    overflow: hidden;
    position: relative;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stats-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: rgba(255,255,255,0.2);
}

.stats-progress .progress-bar {
    height: 100%;
    background: rgba(255,255,255,0.5);
    width: 75%;
    animation: progressAnimation 2s ease-in-out;
}

@keyframes progressAnimation {
    from { width: 0%; }
    to { width: 75%; }
}

.action-cards {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.action-card {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-card:hover {
    background: #fff;
    border-color: #007bff;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0,123,255,0.15);
    color: inherit;
    text-decoration: none;
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
    flex-shrink: 0;
}

.action-content {
    flex: 1;
}

.action-content h6 {
    margin-bottom: 5px;
    font-weight: 600;
}

.action-badge {
    margin-left: 15px;
}

.schedule-summary {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #e9ecef;
}

.schedule-item {
    display: flex;
    align-items: center;
    padding: 12px 0;
}

.schedule-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 12px;
}

.schedule-content {
    display: flex;
    flex-direction: column;
}

.schedule-label {
    font-weight: 600;
    font-size: 0.9rem;
}

.schedule-count {
    font-size: 0.8rem;
    color: #6c757d;
}

.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    padding: 20px;
}

.badge {
    font-size: 0.85em;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-fluid {
        padding: 15px;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }
    
    .d-flex.gap-2 {
        width: 100%;
    }
    
    .d-flex.gap-2 .btn {
        flex: 1;
    }
    
    .action-card {
        padding: 15px;
    }
    
    .action-icon {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }
}

/* Animation for cards */
.card {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Staggered animation for stats cards */
.stats-card:nth-child(1) { animation-delay: 0.1s; }
.stats-card:nth-child(2) { animation-delay: 0.2s; }
.stats-card:nth-child(3) { animation-delay: 0.3s; }
.stats-card:nth-child(4) { animation-delay: 0.4s; }
</style>
@endsection