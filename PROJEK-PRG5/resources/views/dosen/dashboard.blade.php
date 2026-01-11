@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-tachometer-alt text-primary"></i> Dashboard Dosen</h2>
                    <p class="text-muted mb-0">Selamat datang kembali, kelola jadwal dan ketersediaan Anda</p>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="profile-avatar">
                                <i class="fas fa-user-tie fa-4x text-primary"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h4 class="mb-2">{{ $dosen->nama }}</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="mb-1"><i class="fas fa-id-card text-muted me-2"></i><strong>NIP:</strong> {{ $dosen->nip }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1"><i class="fas fa-graduation-cap text-muted me-2"></i><strong>Pendidikan:</strong> {{ $dosen->pendidikan }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1">
                                        <i class="fas fa-star text-muted me-2"></i><strong>Status:</strong>
                                        @if($dosen->is_aa)
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="fas fa-crown"></i> Academic Advisor
                                            </span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">
                                                <i class="fas fa-user"></i> Dosen
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-gradient-primary text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-check fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $stats['availability_count'] }}</h3>
                            <p class="mb-0">Ketersediaan Aktif</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-success text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-presentation fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $stats['jadwal_demo_count'] }}</h3>
                            <p class="mb-0">Jadwal Demo PL</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-info text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-gavel fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $stats['jadwal_sidang_count'] }}</h3>
                            <p class="mb-0">Jadwal Sidang</p>
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
                            <h3 class="mb-2">{{ $stats['availability_count'] + $stats['jadwal_demo_count'] + $stats['jadwal_sidang_count'] }}</h3>
                            <p class="mb-0">Total Aktivitas</p>
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
                            <h5 class="mb-0"><i class="fas fa-calendar-plus text-primary"></i> Ketersediaan</h5>
                        </div>
                        <div class="card-body">
                            <div class="action-cards">
                                <a href="{{ route('dosen.availability.index') }}" class="action-card">
                                    <div class="action-icon bg-primary">
                                        <i class="fas fa-list"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>Kelola Ketersediaan</h6>
                                        <p class="text-muted mb-0">Lihat dan edit jadwal ketersediaan Anda</p>
                                    </div>
                                    <div class="action-badge">
                                        <span class="badge bg-primary">{{ $stats['availability_count'] }}</span>
                                    </div>
                                </a>
                                
                                <a href="{{ route('dosen.availability.create') }}" class="action-card">
                                    <div class="action-icon bg-success">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>Tambah Ketersediaan</h6>
                                        <p class="text-muted mb-0">Buat jadwal ketersediaan baru</p>
                                    </div>
                                    <div class="action-arrow">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt text-success"></i> Jadwal Saya</h5>
                        </div>
                        <div class="card-body">
                            <div class="action-cards">
                                <a href="{{ route('dosen.jadwal.index') }}" class="action-card">
                                    <div class="action-icon bg-info">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>Lihat Semua Jadwal</h6>
                                        <p class="text-muted mb-0">Demo PL dan Sidang Akhir</p>
                                    </div>
                                    <div class="action-arrow">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                
                                <div class="schedule-summary">
                                    <div class="schedule-item">
                                        <div class="schedule-icon bg-success">
                                            <i class="fas fa-presentation"></i>
                                        </div>
                                        <div class="schedule-content">
                                            <span class="schedule-label">Demo PL</span>
                                            <span class="schedule-count">{{ $stats['jadwal_demo_count'] }} jadwal</span>
                                        </div>
                                    </div>
                                    
                                    <div class="schedule-item">
                                        <div class="schedule-icon bg-warning">
                                            <i class="fas fa-gavel"></i>
                                        </div>
                                        <div class="schedule-content">
                                            <span class="schedule-label">Sidang Akhir</span>
                                            <span class="schedule-count">{{ $stats['jadwal_sidang_count'] }} jadwal</span>
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

.profile-avatar {
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    margin-bottom: 10px;
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

.action-arrow {
    margin-left: 15px;
    color: #6c757d;
    transition: all 0.3s ease;
}

.action-card:hover .action-arrow {
    color: #007bff;
    transform: translateX(5px);
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
    
    .action-card {
        padding: 15px;
    }
    
    .action-icon {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }
}
</style>
@endsection