@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-check text-primary"></i> Ketersediaan Saya</h2>
                    <p class="text-muted mb-0">Kelola jadwal ketersediaan Anda untuk penjadwalan Demo PL dan Sidang Akhir</p>
                </div>
                <a href="{{ route('dosen.availability.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus"></i> Tambah Ketersediaan
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-gradient-success text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                            <h4>{{ $availabilities->where('status', true)->count() }}</h4>
                            <p class="mb-0">Slot Tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-info text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                            <h4>{{ $availabilities->groupBy('tanggal')->count() }}</h4>
                            <p class="mb-0">Hari Tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-warning text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x mb-2"></i>
                            <h4>{{ $availabilities->sum(function($item) { return \Carbon\Carbon::parse($item->jam_selesai)->diffInHours(\Carbon\Carbon::parse($item->jam_mulai)); }) }}</h4>
                            <p class="mb-0">Total Jam</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-primary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-user-tie fa-2x mb-2"></i>
                            <h4>{{ $dosen->nama }}</h4>
                            <p class="mb-0">{{ $dosen->is_aa ? 'Dosen AA' : 'Dosen' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Ketersediaan</h5>
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
                    @if($availabilities->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">No</th>
                                        <th class="border-0">Tanggal</th>
                                        <th class="border-0">Waktu</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($availabilities as $index => $availability)
                                    <tr class="availability-row {{ $availability->status ? 'table-success-light' : 'table-danger-light' }}">
                                        <td class="align-middle">
                                            <span class="badge badge-light">{{ $availabilities->firstItem() + $index }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div>
                                                <strong>{{ \Carbon\Carbon::parse($availability->tanggal)->format('d F Y') }}</strong>
                                                <br>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($availability->tanggal)->format('l') }}</small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-clock text-muted me-2"></i>
                                                <div>
                                                    <strong>{{ \Carbon\Carbon::parse($availability->jam_mulai)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($availability->jam_selesai)->format('H:i') }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::parse($availability->jam_selesai)->diffInMinutes(\Carbon\Carbon::parse($availability->jam_mulai)) }} menit
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            @if($availability->status)
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle"></i> Bersedia
                                                </span>
                                            @else
                                                <span class="badge bg-danger px-3 py-2">
                                                    <i class="fas fa-times-circle"></i> Tidak Bersedia
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('dosen.availability.edit', $availability) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('dosen.availability.destroy', $availability) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            data-bs-toggle="tooltip" 
                                                            title="Hapus"
                                                            onclick="return confirm('Yakin ingin menghapus ketersediaan ini?')">
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
                        @if($availabilities->hasPages())
                        <div class="d-flex justify-content-between align-items-center p-4 border-top bg-light">
                            <div class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Menampilkan <strong>{{ $availabilities->firstItem() }}</strong> - <strong>{{ $availabilities->lastItem() }}</strong> 
                                dari <strong>{{ $availabilities->total() }}</strong> data ketersediaan
                            </div>
                            
                            <nav aria-label="Pagination Navigation">
                                <ul class="pagination pagination-modern mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($availabilities->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="fas fa-chevron-left"></i>
                                                <span class="d-none d-sm-inline ms-1">Previous</span>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $availabilities->previousPageUrl() }}">
                                                <i class="fas fa-chevron-left"></i>
                                                <span class="d-none d-sm-inline ms-1">Previous</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($availabilities->getUrlRange(1, $availabilities->lastPage()) as $page => $url)
                                        @if ($page == $availabilities->currentPage())
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
                                    @if ($availabilities->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $availabilities->nextPageUrl() }}">
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
                                <i class="fas fa-calendar-times fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted">Belum ada ketersediaan</h5>
                            <p class="text-muted mb-4">Silakan tambah ketersediaan Anda untuk penjadwalan Demo PL dan Sidang Akhir</p>
                            <a href="{{ route('dosen.availability.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus"></i> Tambah Ketersediaan Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Styles */
.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
}

.table-success-light {
    background-color: rgba(40, 167, 69, 0.1) !important;
}

.table-danger-light {
    background-color: rgba(220, 53, 69, 0.1) !important;
}

.availability-row {
    transition: all 0.3s ease;
}

.availability-row:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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

/* Stats Cards Animation */
.bg-gradient-success,
.bg-gradient-info,
.bg-gradient-warning,
.bg-gradient-primary {
    transition: all 0.3s ease;
}

.bg-gradient-success:hover,
.bg-gradient-info:hover,
.bg-gradient-warning:hover,
.bg-gradient-primary:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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
    
    // Add smooth scroll to pagination
    document.querySelectorAll('.pagination .page-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Add loading state
            const icon = this.querySelector('i');
            if (icon) {
                icon.className = 'fas fa-spinner fa-spin';
            }
        });
    });
});
</script>
@endsection