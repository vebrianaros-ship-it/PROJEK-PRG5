@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-chalkboard-teacher text-success"></i> Detail Dosen</h2>
                    <p class="text-muted mb-0">Informasi lengkap data dosen</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.dosen.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.dosen.edit', $dosen) }}" class="btn btn-success">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Main Info Card -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="header-icon bg-success">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">Informasi Dosen</h5>
                                    <small class="text-muted">Data lengkap dosen</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <label class="info-label">
                                            <i class="fas fa-id-badge text-success me-2"></i>NIP
                                        </label>
                                        <div class="info-value">{{ $dosen->nip }}</div>
                                    </div>

                                    <div class="info-item">
                                        <label class="info-label">
                                            <i class="fas fa-user text-success me-2"></i>Nama Lengkap
                                        </label>
                                        <div class="info-value">{{ $dosen->nama }}</div>
                                    </div>

                                    <div class="info-item">
                                        <label class="info-label">
                                            <i class="fas fa-envelope text-success me-2"></i>Email
                                        </label>
                                        <div class="info-value">
                                            @if(isset($dosen->user->email))
                                                {{ $dosen->user->email }}
                                            @else
                                                <span class="text-muted">Belum ada email</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-item">
                                        <label class="info-label">
                                            <i class="fas fa-graduation-cap text-success me-2"></i>Pendidikan Terakhir
                                        </label>
                                        <div class="info-value">
                                            @if($dosen->pendidikan == 'S3')
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-graduation-cap"></i> {{ $dosen->pendidikan }} - Doktor
                                                </span>
                                            @elseif($dosen->pendidikan == 'S2')
                                                <span class="badge bg-info px-3 py-2">
                                                    <i class="fas fa-user-graduate"></i> {{ $dosen->pendidikan }} - Magister
                                                </span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">
                                                    <i class="fas fa-user"></i> {{ $dosen->pendidikan }} - Sarjana
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <label class="info-label">
                                            <i class="fas fa-user-tie text-success me-2"></i>Status Dosen
                                        </label>
                                        <div class="info-value">
                                            @if($dosen->is_aa)
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-crown"></i> Academic Advisor (AA)
                                                </span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">
                                                    <i class="fas fa-user-tie"></i> Non-AA
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <label class="info-label">
                                            <i class="fas fa-toggle-on text-success me-2"></i>Status Aktif
                                        </label>
                                        <div class="info-value">
                                            @if($dosen->status)
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle"></i> Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-danger px-3 py-2">
                                                    <i class="fas fa-times-circle"></i> Tidak Aktif
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelompok Bimbingan -->
                    @if($dosen->kelompok->count() > 0)
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="header-icon bg-info">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">Kelompok Bimbingan</h5>
                                    <small class="text-muted">Kelompok yang dibimbing dosen</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($dosen->kelompok as $kelompok)
                                <div class="col-md-6 mb-3">
                                    <div class="kelompok-card">
                                        <div class="kelompok-header">
                                            <div class="kelompok-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="kelompok-info">
                                                <h6 class="mb-1">
                                                    <a href="{{ route('admin.kelompok.show', $kelompok->id) }}" class="text-decoration-none">
                                                        {{ $kelompok->nama_kelompok }}
                                                    </a>
                                                </h6>
                                                @php
                                                    $pembimbing = $kelompok->pembimbing->where('dosen_id', $dosen->id)->first();
                                                @endphp
                                                <small class="text-muted">
                                                    @if($pembimbing && $pembimbing->is_utama)
                                                        <span class="badge bg-success">Pembimbing Utama</span>
                                                    @else
                                                        <span class="badge bg-secondary">Pembimbing</span>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        <div class="kelompok-members">
                                            @foreach($kelompok->mahasiswa as $mahasiswa)
                                                <span class="badge bg-light text-dark me-1 mb-1">
                                                    <i class="fas fa-user"></i> {{ $mahasiswa->nama }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Jadwal Demo/Sidang -->
                    @if($dosen->is_aa)
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="header-icon bg-warning">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">Jadwal sebagai Ketua</h5>
                                    <small class="text-muted">Jadwal demo dan sidang sebagai ketua (AA)</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="schedule-stat">
                                        <div class="schedule-icon bg-primary">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="schedule-content">
                                            <div class="schedule-number">{{ $dosen->jadwalDemoAsKetua->count() }}</div>
                                            <div class="schedule-label">Demo Biasa</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="schedule-stat">
                                        <div class="schedule-icon bg-warning">
                                            <i class="fas fa-calendar-plus"></i>
                                        </div>
                                        <div class="schedule-content">
                                            <div class="schedule-number">{{ $dosen->jadwalDemoPLAsKetua->count() }}</div>
                                            <div class="schedule-label">Demo PL</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="schedule-stat">
                                        <div class="schedule-icon bg-danger">
                                            <i class="fas fa-gavel"></i>
                                        </div>
                                        <div class="schedule-content">
                                            <div class="schedule-number">{{ $dosen->jadwalSidangAsKetua->count() }}</div>
                                            <div class="schedule-label">Sidang</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Quick Stats -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0"><i class="fas fa-chart-bar text-success"></i> Statistik</h6>
                        </div>
                        <div class="card-body">
                            <div class="stat-item">
                                <div class="stat-icon bg-success">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number">{{ $dosen->kelompok->count() }}</div>
                                    <div class="stat-label">Kelompok Bimbingan</div>
                                </div>
                            </div>

                            <div class="stat-item">
                                <div class="stat-icon bg-primary">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number">{{ $dosen->kelompok->sum(function($k) { return $k->mahasiswa->count(); }) }}</div>
                                    <div class="stat-label">Total Mahasiswa</div>
                                </div>
                            </div>

                            @if($dosen->is_aa)
                            <div class="stat-item">
                                <div class="stat-icon bg-warning">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number">
                                        {{ $dosen->jadwalDemoAsKetua->count() + $dosen->jadwalDemoPLAsKetua->count() + $dosen->jadwalSidangAsKetua->count() }}
                                    </div>
                                    <div class="stat-label">Total Jadwal</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Account Info -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0"><i class="fas fa-user-cog text-success"></i> Informasi Akun</h6>
                        </div>
                        <div class="card-body">
                            <div class="account-item">
                                <label class="account-label">Role</label>
                                <div class="account-value">
                                    <span class="badge bg-success">Dosen</span>
                                </div>
                            </div>

                            <div class="account-item">
                                <label class="account-label">Status AA</label>
                                <div class="account-value">
                                    @if($dosen->is_aa)
                                        <span class="badge bg-success">Academic Advisor</span>
                                    @else
                                        <span class="badge bg-secondary">Non-AA</span>
                                    @endif
                                </div>
                            </div>

                            <div class="account-item">
                                <label class="account-label">Password Default</label>
                                <div class="account-value">
                                    <span class="text-muted">{{ $dosen->nip }}</span>
                                </div>
                            </div>

                            <div class="account-item">
                                <label class="account-label">Dibuat</label>
                                <div class="account-value">
                                    <span class="text-muted">{{ $dosen->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>

                            <div class="account-item">
                                <label class="account-label">Terakhir Update</label>
                                <div class="account-value">
                                    <span class="text-muted">{{ $dosen->updated_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0"><i class="fas fa-cogs text-success"></i> Aksi</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.dosen.edit', $dosen) }}" class="btn btn-success">
                                    <i class="fas fa-edit me-2"></i>Edit Data
                                </a>
                                
                                <a href="{{ route('admin.kelompok.create') }}?dosen={{ $dosen->id }}" class="btn btn-info">
                                    <i class="fas fa-users me-2"></i>Tambah ke Kelompok
                                </a>

                                @if($dosen->is_aa)
                                <a href="{{ route('admin.jadwal-demo.create') }}?ketua={{ $dosen->id }}" class="btn btn-primary">
                                    <i class="fas fa-calendar-plus me-2"></i>Jadwalkan Demo
                                </a>
                                @endif

                                @if($dosen->status)
                                <form action="{{ route('admin.dosen.destroy', $dosen) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100" 
                                            onclick="return confirm('Yakin ingin menonaktifkan dosen ini?')">
                                        <i class="fas fa-user-times me-2"></i>Nonaktifkan
                                    </button>
                                </form>
                                @endif
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
.card {
    border: none;
    border-radius: 15px;
    animation: fadeInUp 0.6s ease-out;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.header-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.info-item {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.info-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    display: block;
    font-size: 0.9rem;
}

.info-value {
    font-size: 1rem;
    color: #212529;
    font-weight: 500;
}

.kelompok-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    padding: 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.kelompok-card:hover {
    border-color: #17a2b8;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.15);
}

.kelompok-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.kelompok-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 12px;
    flex-shrink: 0;
}

.kelompok-info {
    flex: 1;
}

.kelompok-members {
    margin-top: 8px;
}

.schedule-stat {
    display: flex;
    align-items: center;
    padding: 15px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    margin-bottom: 15px;
}

.schedule-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
    flex-shrink: 0;
}

.schedule-content {
    flex: 1;
}

.schedule-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #212529;
    line-height: 1;
}

.schedule-label {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 2px;
}

.stat-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f1f3f4;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
    flex-shrink: 0;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #212529;
    line-height: 1;
}

.stat-label {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 2px;
}

.account-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f1f3f4;
}

.account-item:last-child {
    border-bottom: none;
}

.account-label {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
}

.account-value {
    font-size: 0.9rem;
    color: #212529;
}

.badge {
    font-size: 0.8rem;
}

.btn {
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Animation */
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
    
    .card-header {
        padding: 15px;
    }
    
    .header-icon {
        width: 40px;
        height: 40px;
    }
    
    .kelompok-card {
        margin-bottom: 15px;
    }
    
    .schedule-stat {
        padding: 10px;
        margin-bottom: 10px;
    }
    
    .schedule-icon, .stat-icon {
        width: 35px;
        height: 35px;
        margin-right: 10px;
    }
    
    .schedule-number, .stat-number {
        font-size: 1.2rem;
    }
}
</style>
@endsection