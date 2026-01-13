@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-plus text-warning"></i> Jadwal Demo PL</h2>
                    <p class="text-muted mb-0">Kelola penjadwalan Demo Proposal Lanjutan mahasiswa</p>
                </div>
                <a href="{{ route('admin.jadwal-demo-pl.create') }}" class="btn btn-warning btn-lg">
                    <i class="fas fa-plus"></i> Buat Jadwal Demo PL
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Kelompok Eligible Alert -->
            @if($kelompokEligible->count() > 0)
            <div class="alert alert-warning shadow-sm mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-graduation-cap fa-2x text-warning me-3"></i>
                    <div>
                        <h5 class="mb-1">Kelompok Siap Demo PL</h5>
                        <p class="mb-0">{{ $kelompokEligible->count() }} kelompok telah selesai demo biasa dan siap dijadwalkan Demo PL</p>
                    </div>
                </div>
                <div class="row">
                    @foreach($kelompokEligible as $kelompok)
                    <div class="col-md-6 mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users text-warning me-2"></i>
                            <strong>{{ $kelompok->nama_kelompok }}</strong>
                            <span class="ms-auto">
                                <a href="{{ route('admin.jadwal-demo-pl.create', ['kelompok' => $kelompok->id]) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-calendar-plus"></i> Jadwalkan
                                </a>
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-gradient-warning text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-plus fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $jadwalDemoPL->total() }}</h3>
                            <p class="mb-0">Total Jadwal Demo PL</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-success text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $jadwalDemoPL->where('status', 'terjadwal')->count() }}</h3>
                            <p class="mb-0">Terjadwal</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-primary text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-graduation-cap fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $kelompokEligible->count() }}</h3>
                            <p class="mb-0">Siap Demo PL</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-info text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-trophy fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $jadwalDemoPL->where('status', 'selesai')->count() }}</h3>
                            <p class="mb-0">Selesai</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Jadwal Demo PL</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-sm active">
                                <i class="fas fa-table"></i> Tabel
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-calendar"></i> Kalender
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($jadwalDemoPL->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">No</th>
                                        <th class="border-0">Kelompok</th>
                                        <th class="border-0">Tanggal & Waktu</th>
                                        <th class="border-0">Lokasi</th>
                                        <th class="border-0">Ketua Demo</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalDemoPL as $index => $jadwal)
                                    <tr class="table-row">
                                        <td class="align-middle">
                                            <strong>{{ $jadwalDemoPL->firstItem() + $index }}</strong>
                                        </td>
                                        <td class="align-middle">
                                            <div>
                                                <strong>{{ $jadwal->kelompok->nama_kelompok }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    @if($jadwal->kelompok->mahasiswa->count() > 0)
                                                        @foreach($jadwal->kelompok->mahasiswa as $mhs)
                                                            <i class="fas fa-user"></i> {{ $mhs->nama }}{{ !$loop->last ? ', ' : '' }}
                                                        @endforeach
                                                    @else
                                                        <i class="fas fa-users-slash"></i> Belum ada anggota
                                                    @endif
                                                </small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div>
                                                <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $jadwal->jam }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                            {{ $jadwal->lokasi }}
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-warning px-3 py-2">
                                                <i class="fas fa-crown"></i> {{ $jadwal->ketuaDemo->nama }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @if($jadwal->status == 'terjadwal')
                                                <span class="badge bg-warning px-3 py-2">
                                                    <i class="fas fa-check-circle"></i> Terjadwal
                                                </span>
                                            @elseif($jadwal->status == 'selesai')
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-trophy"></i> Selesai
                                                </span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">
                                                    <i class="fas fa-clock"></i> Menunggu
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.jadwal-demo-pl.show', $jadwal->id) }}" 
                                                   class="btn btn-sm btn-outline-info" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.jadwal-demo-pl.edit', $jadwal->id) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.jadwal-demo-pl.destroy', $jadwal->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            data-bs-toggle="tooltip" 
                                                            title="Hapus"
                                                            onclick="return confirm('Yakin ingin menghapus jadwal Demo PL ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Custom Pagination -->
                        @if($jadwalDemoPL->hasPages())
                        <div class="d-flex justify-content-between align-items-center p-4 border-top bg-light">
                            <div class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Menampilkan <strong>{{ $jadwalDemoPL->firstItem() }}</strong> - <strong>{{ $jadwalDemoPL->lastItem() }}</strong> 
                                dari <strong>{{ $jadwalDemoPL->total() }}</strong> jadwal demo PL
                            </div>
                            
                            <nav aria-label="Pagination Navigation">
                                <ul class="pagination pagination-modern mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($jadwalDemoPL->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="fas fa-chevron-left"></i>
                                                <span class="d-none d-sm-inline ms-1">Previous</span>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $jadwalDemoPL->previousPageUrl() }}">
                                                <i class="fas fa-chevron-left"></i>
                                                <span class="d-none d-sm-inline ms-1">Previous</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($jadwalDemoPL->getUrlRange(1, $jadwalDemoPL->lastPage()) as $page => $url)
                                        @if ($page == $jadwalDemoPL->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($jadwalDemoPL->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $jadwalDemoPL->nextPageUrl() }}">
                                                <span class="d-none d-sm-inline me-1">Next</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <span class="d-none d-sm-inline me-1">Next</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-calendar-plus fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted">Belum ada jadwal Demo PL</h5>
                            <p class="text-muted mb-4">Silakan buat jadwal Demo PL untuk kelompok yang sudah selesai demo biasa</p>
                            @if($kelompokEligible->count() > 0)
                                <a href="{{ route('admin.jadwal-demo-pl.create') }}" class="btn btn-warning btn-lg">
                                    <i class="fas fa-plus"></i> Buat Jadwal Demo PL Pertama
                                </a>
                            @else
                                <p class="text-muted">Tidak ada kelompok yang siap untuk dijadwalkan Demo PL</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kelompok Eligible Section -->
            @if($kelompokEligible->count() > 0)
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="header-icon bg-warning">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">Kelompok Siap Demo PL</h5>
                            <small class="text-muted">Kelompok yang sudah menyelesaikan demo biasa dan siap dijadwalkan Demo PL</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Kelompok</th>
                                    <th class="border-0">Anggota</th>
                                    <th class="border-0 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kelompokEligible as $kelompok)
                                <tr class="table-row">
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="profile-avatar-sm me-3">
                                                <i class="fas fa-users fa-lg text-warning"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $kelompok->nama_kelompok }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-check-circle text-success me-1"></i>
                                                    Demo biasa selesai
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @foreach($kelompok->mahasiswa as $mahasiswa)
                                            <div class="mb-1">
                                                <span class="badge bg-light text-dark px-2 py-1">
                                                    <i class="fas fa-user me-1"></i>
                                                    {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
                                                </span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.jadwal-demo-pl.create', ['kelompok' => $kelompok->id]) }}" 
                                           class="btn btn-warning btn-sm"
                                           data-bs-toggle="tooltip" 
                                           title="Jadwalkan Demo PL">
                                            <i class="fas fa-calendar-plus me-1"></i>
                                            Jadwalkan Demo PL
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Modern Admin Styles */
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

.profile-avatar-sm {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.table-row {
    transition: all 0.3s ease;
}

.table-row:hover {
    background-color: rgba(255, 193, 7, 0.05);
    transform: translateX(5px);
}

.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.badge {
    font-size: 0.85em;
}

.btn-group .btn {
    border-radius: 6px;
    margin: 0 2px;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85em;
    letter-spacing: 0.5px;
}

/* Modern Pagination Styles */
.pagination-modern {
    gap: 5px;
}

.pagination-modern .page-link {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    color: #495057;
    font-weight: 500;
    padding: 8px 12px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.pagination-modern .page-link:hover {
    background-color: #ffc107;
    border-color: #ffc107;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(255,193,7,0.3);
}

.pagination-modern .page-item.active .page-link {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    border-color: #ffc107;
    color: white;
    box-shadow: 0 4px 12px rgba(255,193,7,0.4);
}

.pagination-modern .page-item.disabled .page-link {
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #6c757d;
    cursor: not-allowed;
}

.pagination-modern .page-item.disabled .page-link:hover {
    transform: none;
    box-shadow: none;
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #6c757d;
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
    
    .btn-lg {
        width: 100%;
    }
    
    .pagination-modern {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .d-flex.justify-content-between.align-items-center.p-4 {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}

/* Additional table fixes */
.table-responsive {
    overflow-x: hidden !important;
}

.table {
    margin-bottom: 0;
}

.table td {
    vertical-align: middle;
    padding: 12px 8px;
}

.table th {
    padding: 15px 8px;
}

/* Adjust column widths */
.table th:nth-child(1), .table td:nth-child(1) { width: 5%; } /* No */
.table th:nth-child(2), .table td:nth-child(2) { width: 25%; } /* Kelompok */
.table th:nth-child(3), .table td:nth-child(3) { width: 18%; } /* Tanggal */
.table th:nth-child(4), .table td:nth-child(4) { width: 15%; } /* Lokasi */
.table th:nth-child(5), .table td:nth-child(5) { width: 17%; } /* Ketua */
.table th:nth-child(6), .table td:nth-child(6) { width: 10%; } /* Status */
.table th:nth-child(7), .table td:nth-child(7) { width: 10%; } /* Aksi */

/* Tooltip Styling */
.tooltip {
    font-size: 0.875rem;
}

.tooltip-inner {
    background-color: #343a40;
    border-radius: 6px;
}
</style>

<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection