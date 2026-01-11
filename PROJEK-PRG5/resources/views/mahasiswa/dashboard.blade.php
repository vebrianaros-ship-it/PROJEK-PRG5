@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-user-graduate"></i> Dashboard Mahasiswa</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-user"></i> Selamat datang, {{ $mahasiswa->nama }}</h5>
                                <p class="mb-0">
                                    <strong>NIM:</strong> {{ $mahasiswa->nim }} | 
                                    <strong>Program Studi:</strong> {{ $mahasiswa->prodi }} | 
                                    <strong>Tingkat:</strong> {{ $mahasiswa->tingkat }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if(!$stats['has_kelompok'])
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <h5><i class="fas fa-exclamation-triangle"></i> Belum Tergabung dalam Kelompok</h5>
                                    <p>Anda belum tergabung dalam kelompok manapun. Silakan hubungi PIC PKTA untuk penempatan kelompok.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <h5><i class="fas fa-users"></i> Kelompok: {{ $stats['kelompok_name'] }}</h5>
                                    <p class="mb-0">Anda tergabung dalam kelompok <strong>{{ $stats['kelompok_name'] }}</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card {{ $stats['pendaftaran_demo'] ? 'bg-success' : 'bg-warning' }} text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-alt fa-2x mb-2"></i>
                                        <h5>Pendaftaran Demo</h5>
                                        <p>
                                            @if($stats['pendaftaran_demo'])
                                                Status: {{ ucfirst($stats['pendaftaran_demo']->status) }}
                                            @else
                                                Belum Mendaftar
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card {{ $stats['jadwal_demo'] ? 'bg-info' : 'bg-secondary' }} text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-presentation fa-2x mb-2"></i>
                                        <h5>Jadwal Demo</h5>
                                        <p>
                                            @if($stats['jadwal_demo'])
                                                {{ $stats['jadwal_demo']->tanggal->format('d/m/Y') }}
                                            @else
                                                Belum Dijadwalkan
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card {{ $stats['jadwal_sidang'] ? 'bg-primary' : 'bg-secondary' }} text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-gavel fa-2x mb-2"></i>
                                        <h5>Jadwal Sidang</h5>
                                        <p>
                                            @if($stats['jadwal_sidang'])
                                                {{ $stats['jadwal_sidang']->tanggal->format('d/m/Y') }}
                                            @else
                                                Belum Dijadwalkan
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><i class="fas fa-file-upload"></i> Pendaftaran Demo</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group">
                                            <a href="{{ route('mahasiswa.pendaftaran-demo.index') }}" class="list-group-item list-group-item-action">
                                                <i class="fas fa-list text-info"></i> Lihat Status Pendaftaran
                                            </a>
                                            @if(!$stats['pendaftaran_demo'] || $stats['pendaftaran_demo']->status == 'ditolak')
                                            <a href="{{ route('mahasiswa.pendaftaran-demo.create') }}" class="list-group-item list-group-item-action">
                                                <i class="fas fa-plus text-success"></i> Daftar Demo Baru
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><i class="fas fa-calendar-alt"></i> Jadwal Saya</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group">
                                            <a href="{{ route('mahasiswa.jadwal.index') }}" class="list-group-item list-group-item-action">
                                                <i class="fas fa-eye text-info"></i> Lihat Semua Jadwal
                                            </a>
                                            @if($stats['jadwal_demo'])
                                            <div class="list-group-item">
                                                <i class="fas fa-presentation text-success"></i> Demo: {{ $stats['jadwal_demo']->tanggal->format('d/m/Y H:i') }}
                                            </div>
                                            @endif
                                            @if($stats['jadwal_sidang'])
                                            <div class="list-group-item">
                                                <i class="fas fa-gavel text-primary"></i> Sidang: {{ $stats['jadwal_sidang']->tanggal->format('d/m/Y H:i') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection