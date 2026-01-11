@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-chalkboard-teacher text-primary"></i> Data Dosen</h2>
                    <p class="text-muted mb-0">Kelola data dosen dan informasi akademik</p>
                </div>
                <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus"></i> Tambah Dosen
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-gradient-primary text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $dosen->total() }}</h3>
                            <p class="mb-0">Total Dosen</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-success text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-crown fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $dosen->where('is_aa', true)->count() }}</h3>
                            <p class="mb-0">Academic Advisor</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-info text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-graduation-cap fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $dosen->where('pendidikan', 'S3')->count() }}</h3>
                            <p class="mb-0">Doktor (S3)</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gradient-warning text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $dosen->where('status', true)->count() }}</h3>
                            <p class="mb-0">Dosen Aktif</p>
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
                        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Dosen</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-sm active">
                                <i class="fas fa-table"></i> Tabel
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-th-large"></i> Grid
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($dosen->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">No</th>
                                        <th class="border-0">NIP</th>
                                        <th class="border-0">Nama</th>
                                        <th class="border-0">Pendidikan</th>
                                        <th class="border-0">Jenis Dosen</th>
                                        <th class="border-0">Email</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dosen as $index => $dsn)
                                    <tr class="table-row">
                                        <td class="align-middle">
                                            <strong>{{ $index + 1 }}</strong>
                                        </td>
                                        <td class="align-middle">
                                            <div>
                                                <strong>{{ $dsn->nip }}</strong>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="profile-avatar-sm me-3">
                                                    <i class="fas fa-user-tie fa-lg text-primary"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $dsn->nama }}</strong>
                                                    <br>
                                                    <small class="text-muted">Dosen</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            @if($dsn->pendidikan == 'S3')
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-graduation-cap"></i> {{ $dsn->pendidikan }}
                                                </span>
                                            @elseif($dsn->pendidikan == 'S2')
                                                <span class="badge bg-info px-3 py-2">
                                                    <i class="fas fa-user-graduate"></i> {{ $dsn->pendidikan }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">
                                                    <i class="fas fa-user"></i> {{ $dsn->pendidikan }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($dsn->is_aa)
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-crown"></i> Academic Advisor
                                                </span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">
                                                    <i class="fas fa-user-tie"></i> Non-AA
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if(isset($dsn->user->email))
                                                <i class="fas fa-envelope text-muted me-2"></i>
                                                {{ $dsn->user->email }}
                                            @else
                                                <span class="text-muted">
                                                    <i class="fas fa-envelope-slash me-2"></i>
                                                    Belum ada email
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($dsn->status)
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle"></i> Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-danger px-3 py-2">
                                                    <i class="fas fa-times-circle"></i> Tidak Aktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.dosen.show', $dsn) }}" 
                                                   class="btn btn-sm btn-outline-info" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.dosen.edit', $dsn) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($dsn->status)
                                                <form action="{{ route('admin.dosen.destroy', $dsn) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            data-bs-toggle="tooltip" 
                                                            title="Nonaktifkan"
                                                            onclick="return confirm('Yakin ingin menonaktifkan dosen ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Custom Pagination -->
                        @if($dosen->hasPages())
                        <div class="d-flex justify-content-between align-items-center p-4 border-top bg-light">
                            <div class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Menampilkan <strong>{{ $dosen->firstItem() }}</strong> - <strong>{{ $dosen->lastItem() }}</strong> 
                                dari <strong>{{ $dosen->total() }}</strong> dosen
                            </div>
                            
                            <nav aria-label="Pagination Navigation">
                                <ul class="pagination pagination-modern mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($dosen->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="fas fa-chevron-left"></i>
                                                <span class="d-none d-sm-inline ms-1">Previous</span>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $dosen->previousPageUrl() }}">
                                                <i class="fas fa-chevron-left"></i>
                                                <span class="d-none d-sm-inline ms-1">Previous</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($dosen->getUrlRange(1, $dosen->lastPage()) as $page => $url)
                                        @if ($page == $dosen->currentPage())
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
                                    @if ($dosen->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $dosen->nextPageUrl() }}">
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
                                <i class="fas fa-chalkboard-teacher fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted">Belum ada dosen</h5>
                            <p class="text-muted mb-4">Silakan tambah dosen baru untuk memulai</p>
                            <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus"></i> Tambah Dosen Pertama
                            </a>
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