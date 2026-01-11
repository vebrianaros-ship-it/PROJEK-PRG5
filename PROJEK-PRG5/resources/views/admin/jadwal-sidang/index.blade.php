@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-gavel text-primary"></i> Jadwal Sidang Akhir</h2>
                    <p class="text-muted mb-0">Kelola penjadwalan Sidang Akhir mahasiswa</p>
                </div>
                <a href="{{ route('admin.jadwal-sidang.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus"></i> Buat Jadwal Sidang
                </a>
            </div>

            <!-- Kelompok Siap Sidang Alert -->
            @if($kelompokSiapSidang->count() > 0)
            <div class="alert alert-info shadow-sm mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-graduation-cap fa-2x text-info me-3"></i>
                    <div>
                        <h5 class="mb-1">Kelompok Siap Sidang</h5>
                        <p class="mb-0">{{ $kelompokSiapSidang->count() }} kelompok telah selesai demo dan siap dijadwalkan sidang</p>
                    </div>
                </div>
                <div class="row">
                    @foreach($kelompokSiapSidang as $kelompok)
                    <div class="col-md-6 mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users text-info me-2"></i>
                            <strong>{{ $kelompok->nama_kelompok }}</strong>
                            <span class="ms-auto">
                                <span class="badge bg-success">
                                    <i class="fas fa-check"></i> Demo Selesai
                                </span>
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
                    <div class="card bg-gradient-primary text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-gavel fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $jadwalSidang->total() }}</h3>
                            <p class="mb-0">Total Jadwal Sidang</p>
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
                            <h3 class="mb-2">{{ $jadwalSidang->where('status', 'terjadwal')->count() }}</h3>
                            <p class="mb-0">Terjadwal</p>
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
                            <h3 class="mb-2">{{ $kelompokSiapSidang->count() }}</h3>
                            <p class="mb-0">Siap Sidang</p>
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
                            <h3 class="mb-2">{{ $jadwalSidang->where('status', 'selesai')->count() }}</h3>
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
                        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Jadwal Sidang Akhir</h5>
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
                    @if($jadwalSidang->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">No</th>
                                        <th class="border-0">Kelompok</th>
                                        <th class="border-0">Tanggal & Waktu</th>
                                        <th class="border-0">Lokasi</th>
                                        <th class="border-0">Ketua Sidang</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalSidang as $index => $jadwal)
                                    <tr class="table-row">
                                        <td class="align-middle">
                                            <strong>{{ $index + 1 }}</strong>
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
                                                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                            {{ $jadwal->lokasi }}
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-primary px-3 py-2">
                                                <i class="fas fa-gavel"></i> {{ $jadwal->ketuaSidang->nama }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @if($jadwal->status == 'terjadwal')
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle"></i> Terjadwal
                                                </span>
                                            @else
                                                <span class="badge bg-info px-3 py-2">
                                                    <i class="fas fa-trophy"></i> Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.jadwal-sidang.show', $jadwal) }}" 
                                                   class="btn btn-sm btn-outline-info" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.jadwal-sidang.edit', $jadwal) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.jadwal-sidang.destroy', $jadwal) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            data-bs-toggle="tooltip" 
                                                            title="Hapus"
                                                            onclick="return confirm('Yakin ingin menghapus jadwal sidang ini?')">
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
                        @if($jadwalSidang->hasPages())
                        <div class="d-flex justify-content-between align-items-center p-4 border-top bg-light">
                            <div class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Menampilkan <strong>1</strong> - <strong>{{ $jadwalSidang->count() }}</strong> 
                                dari <strong>{{ $jadwalSidang->total() }}</strong> jadwal sidang
                            </div>
                            
                            <nav aria-label="Pagination Navigation">
                                <ul class="pagination pagination-modern mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($jadwalSidang->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="fas fa-chevron-left"></i>
                                                <span class="d-none d-sm-inline ms-1">Previous</span>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $jadwalSidang->previousPageUrl() }}">
                                                <i class="fas fa-chevron-left"></i>
                                                <span class="d-none d-sm-inline ms-1">Previous</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($jadwalSidang->getUrlRange(1, $jadwalSidang->lastPage()) as $page => $url)
                                        @if ($page == $jadwalSidang->currentPage())
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
                                    @if ($jadwalSidang->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $jadwalSidang->nextPageUrl() }}">
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
                                <i class="fas fa-gavel fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted">Belum ada jadwal sidang</h5>
                            <p class="text-muted mb-4">Silakan buat jadwal sidang untuk kelompok yang sudah selesai demo</p>
                            @if($kelompokSiapSidang->count() > 0)
                                <a href="{{ route('admin.jadwal-sidang.create') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus"></i> Buat Jadwal Sidang Pertama
                                </a>
                            @else
                                <p class="text-muted">Tidak ada kelompok yang siap untuk dijadwalkan sidang</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
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

.table-row {
    transition: all 0.3s ease;
}

.table-row:hover {
    background-color: rgba(0, 123, 255, 0.05);
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
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,123,255,0.3);
}

.pagination-modern .page-item.active .page-link {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
    border-color: #007bff;
    color: white;
    box-shadow: 0 4px 12px rgba(0,123,255,0.4);
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