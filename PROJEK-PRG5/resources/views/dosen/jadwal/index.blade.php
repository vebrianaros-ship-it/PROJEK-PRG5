@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-alt text-primary"></i> Jadwal Saya</h2>
                    <p class="text-muted mb-0">Lihat semua jadwal Demo PL dan Sidang Akhir yang melibatkan Anda</p>
                </div>
            </div>

            <!-- Profile Info Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="profile-avatar">
                                <i class="fas fa-user-tie fa-3x text-primary"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h4 class="mb-2">{{ $dosen->nama }}</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><i class="fas fa-id-card text-muted me-2"></i><strong>NIP:</strong> {{ $dosen->nip }}</p>
                                </div>
                                <div class="col-md-6">
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
                <div class="col-md-4">
                    <div class="card bg-gradient-success text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-presentation fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $jadwalDemo->count() }}</h3>
                            <p class="mb-0">Jadwal Demo PL</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-gradient-info text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-gavel fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $jadwalSidang->count() }}</h3>
                            <p class="mb-0">Jadwal Sidang</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-gradient-primary text-white stats-card">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-check fa-2x mb-3"></i>
                            <h3 class="mb-2">{{ $jadwalDemo->count() + $jadwalSidang->count() }}</h3>
                            <p class="mb-0">Total Jadwal</p>
                            <div class="stats-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Demo Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-presentation text-success"></i> Jadwal Demo PL</h5>
                        <span class="badge bg-success px-3 py-2">{{ $jadwalDemo->count() }} jadwal</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($jadwalDemo->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">Tanggal & Waktu</th>
                                        <th class="border-0">Kelompok</th>
                                        <th class="border-0">Peran</th>
                                        <th class="border-0">Tim Penguji</th>
                                        <th class="border-0 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalDemo as $demo)
                                    <tr class="schedule-row">
                                        <td class="align-middle">
                                            <div>
                                                <strong>{{ \Carbon\Carbon::parse($demo->tanggal)->format('d F Y') }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($demo->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($demo->jam_selesai)->format('H:i') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div>
                                                <strong>{{ $demo->kelompok->nama_kelompok }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    @foreach($demo->kelompok->mahasiswa as $mhs)
                                                        {{ $mhs->nama }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            @if($demo->ketua_demo == $dosen->id)
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-crown"></i> Ketua Demo
                                                </span>
                                            @elseif($demo->penguji1 == $dosen->id)
                                                <span class="badge bg-primary px-3 py-2">
                                                    <i class="fas fa-user-graduate"></i> Penguji 1
                                                </span>
                                            @elseif($demo->penguji2 == $dosen->id)
                                                <span class="badge bg-info px-3 py-2">
                                                    <i class="fas fa-user-check"></i> Penguji 2
                                                </span>
                                            @elseif($demo->penguji3 == $dosen->id)
                                                <span class="badge bg-secondary px-3 py-2">
                                                    <i class="fas fa-industry"></i> Penguji 3
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <small>
                                                <div class="mb-1"><strong>Ketua:</strong> {{ $demo->ketuaDemo->nama }}</div>
                                                <div class="mb-1"><strong>P1:</strong> {{ $demo->pengujiSatu->nama }}</div>
                                                <div class="mb-1"><strong>P2:</strong> {{ $demo->pengujiDua->nama }}</div>
                                                @if($demo->pengujiTiga)
                                                    <div><strong>P3:</strong> {{ $demo->pengujiTiga->nama }}</div>
                                                @endif
                                            </small>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($demo->status == 'terjadwal')
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle"></i> Terjadwal
                                                </span>
                                            @else
                                                <span class="badge bg-info px-3 py-2">
                                                    <i class="fas fa-clock"></i> {{ ucfirst($demo->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-presentation fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted">Belum ada jadwal demo</h5>
                            <p class="text-muted mb-4">Anda belum memiliki jadwal Demo PL yang terdaftar</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Jadwal Sidang Section -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-gavel text-info"></i> Jadwal Sidang Akhir</h5>
                        <span class="badge bg-info px-3 py-2">{{ $jadwalSidang->count() }} jadwal</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($jadwalSidang->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">Tanggal & Waktu</th>
                                        <th class="border-0">Kelompok</th>
                                        <th class="border-0">Lokasi</th>
                                        <th class="border-0">Peran</th>
                                        <th class="border-0 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalSidang as $sidang)
                                    <tr class="schedule-row">
                                        <td class="align-middle">
                                            <div>
                                                <strong>{{ \Carbon\Carbon::parse($sidang->tanggal)->format('d F Y') }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($sidang->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($sidang->jam_selesai)->format('H:i') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div>
                                                <strong>{{ $sidang->kelompok->nama_kelompok }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    @foreach($sidang->kelompok->mahasiswa as $mhs)
                                                        {{ $mhs->nama }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                            {{ $sidang->lokasi }}
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-primary px-3 py-2">
                                                <i class="fas fa-gavel"></i> Ketua Sidang
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($sidang->status == 'terjadwal')
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle"></i> Terjadwal
                                                </span>
                                            @else
                                                <span class="badge bg-info px-3 py-2">
                                                    <i class="fas fa-clock"></i> {{ ucfirst($sidang->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-gavel fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted">Belum ada jadwal sidang</h5>
                            <p class="text-muted mb-4">Anda belum memiliki jadwal Sidang Akhir yang terdaftar</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Consistent Modern Styles */
.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
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
    padding: 15px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    margin-bottom: 10px;
}

.schedule-row {
    transition: all 0.3s ease;
}

.schedule-row:hover {
    background-color: rgba(0, 123, 255, 0.05);
    transform: translateX(5px);
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

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85em;
    letter-spacing: 0.5px;
    padding: 15px;
}

.table td {
    padding: 15px;
    vertical-align: middle;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-fluid {
        padding: 15px;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .badge {
        font-size: 0.75em;
        padding: 4px 8px;
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
</style>
@endsection