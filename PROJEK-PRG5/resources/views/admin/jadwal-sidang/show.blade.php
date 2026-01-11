@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-gavel text-primary"></i> Detail Jadwal Sidang Akhir</h2>
                    <p class="text-muted mb-0">Informasi lengkap jadwal sidang akhir</p>
                </div>
                <div>
                    <a href="{{ route('admin.jadwal-sidang.edit', $jadwalSidang) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.jadwal-sidang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Status Card -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card {{ $jadwalSidang->status == 'selesai' ? 'border-success' : 'border-primary' }} shadow-sm">
                        <div class="card-body text-center">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    @if($jadwalSidang->status == 'selesai')
                                        <i class="fas fa-trophy fa-3x text-success"></i>
                                    @else
                                        <i class="fas fa-gavel fa-3x text-primary"></i>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h4 class="mb-1">{{ $jadwalSidang->kelompok->nama_kelompok }}</h4>
                                    <p class="text-muted mb-2">
                                        @if($jadwalSidang->kelompok->mahasiswa->count() > 0)
                                            {{ $jadwalSidang->kelompok->mahasiswa->pluck('nama')->join(' & ') }}
                                        @else
                                            Belum ada anggota
                                        @endif
                                    </p>
                                    <h5 class="mb-0">
                                        <i class="fas fa-calendar me-2"></i>
                                        {{ \Carbon\Carbon::parse($jadwalSidang->tanggal)->format('d F Y') }}
                                        <span class="mx-2">|</span>
                                        <i class="fas fa-clock me-2"></i>
                                        {{ \Carbon\Carbon::parse($jadwalSidang->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwalSidang->jam_selesai)->format('H:i') }}
                                    </h5>
                                </div>
                                <div class="col-md-2">
                                    @if($jadwalSidang->status == 'terjadwal')
                                        <span class="badge bg-success px-4 py-3 fs-6">
                                            <i class="fas fa-check-circle"></i> Terjadwal
                                        </span>
                                    @else
                                        <span class="badge bg-info px-4 py-3 fs-6">
                                            <i class="fas fa-trophy"></i> Selesai
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <!-- Informasi Sidang -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Sidang</h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                    <strong>Lokasi Sidang</strong>
                                </div>
                                <p class="ms-4 mb-0">{{ $jadwalSidang->lokasi }}</p>
                            </div>

                            <div class="info-item mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-gavel text-primary me-3"></i>
                                    <strong>Ketua Sidang</strong>
                                </div>
                                <div class="ms-4">
                                    <p class="mb-1">{{ $jadwalSidang->ketuaSidang->nama }}</p>
                                    <small class="text-muted">
                                        {{ $jadwalSidang->ketuaSidang->nip }} - {{ $jadwalSidang->ketuaSidang->pendidikan }}
                                        @if($jadwalSidang->ketuaSidang->is_aa)
                                            <span class="badge bg-success ms-1">AA</span>
                                        @endif
                                    </small>
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-primary me-3"></i>
                                    <strong>Durasi Sidang</strong>
                                </div>
                                <p class="ms-4 mb-0">
                                    {{ \Carbon\Carbon::parse($jadwalSidang->jam_mulai)->diffInMinutes(\Carbon\Carbon::parse($jadwalSidang->jam_selesai)) }} menit
                                </p>
                            </div>

                            <div class="info-item">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-plus text-primary me-3"></i>
                                    <strong>Dibuat</strong>
                                </div>
                                <p class="ms-4 mb-0">{{ $jadwalSidang->created_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kelompok -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-users"></i> Informasi Kelompok</h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-tag text-success me-3"></i>
                                    <strong>Nama Kelompok</strong>
                                </div>
                                <p class="ms-4 mb-0">{{ $jadwalSidang->kelompok->nama_kelompok }}</p>
                            </div>

                            <div class="info-item mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user-graduate text-success me-3"></i>
                                    <strong>Anggota Kelompok</strong>
                                </div>
                                <div class="ms-4">
                                    @if($jadwalSidang->kelompok->mahasiswa->count() > 0)
                                        @foreach($jadwalSidang->kelompok->mahasiswa as $mhs)
                                        <div class="mb-2">
                                            <p class="mb-1">{{ $mhs->nama }}</p>
                                            <small class="text-muted">{{ $mhs->nim }} - {{ $mhs->prodi }}</small>
                                        </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted mb-0">Belum ada anggota</p>
                                    @endif
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-chalkboard-teacher text-success me-3"></i>
                                    <strong>Dosen Pembimbing</strong>
                                </div>
                                <div class="ms-4">
                                    @if($jadwalSidang->kelompok->pembimbing->count() > 0)
                                        @foreach($jadwalSidang->kelompok->pembimbing as $pembimbing)
                                        <div class="mb-2">
                                            <p class="mb-1">
                                                {{ $pembimbing->dosen->nama }}
                                                @if($pembimbing->is_utama)
                                                    <span class="badge bg-primary">Utama</span>
                                                @endif
                                            </p>
                                            <small class="text-muted">{{ $pembimbing->dosen->nip }}</small>
                                        </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted mb-0">Belum ada pembimbing</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Demo -->
            @if($jadwalSidang->kelompok->jadwalDemo->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-history"></i> Riwayat Demo PL</h5>
                        </div>
                        <div class="card-body">
                            @foreach($jadwalSidang->kelompok->jadwalDemo as $demo)
                            <div class="demo-item mb-3 p-3 border rounded">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <strong>{{ \Carbon\Carbon::parse($demo->tanggal)->format('d F Y') }}</strong><br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($demo->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($demo->jam_selesai)->format('H:i') }}
                                        </small>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Ketua Demo:</strong><br>
                                        <small>{{ $demo->ketuaDemo->nama }}</small>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Tim Penguji:</strong><br>
                                        <small>
                                            P1: {{ $demo->pengujiSatu->nama }}<br>
                                            P2: {{ $demo->pengujiDua->nama }}
                                            @if($demo->pengujiTiga)
                                                <br>P3: {{ $demo->pengujiTiga->nama }}
                                            @endif
                                        </small>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        @if($demo->status == 'selesai')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check"></i> Selesai
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock"></i> {{ ucfirst($demo->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    font-weight: 600;
}

.info-item {
    border-bottom: 1px solid #f8f9fa;
    padding-bottom: 15px;
}

.info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.demo-item {
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.demo-item:hover {
    background-color: #e9ecef;
    transform: translateX(5px);
}

.badge {
    font-size: 0.85em;
}

.btn {
    border-radius: 10px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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
    
    .btn {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .card-body .row {
        text-align: center;
    }
    
    .demo-item .row {
        text-align: left;
    }
}
</style>
@endsection