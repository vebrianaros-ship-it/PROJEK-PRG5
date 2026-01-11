@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-chalkboard-teacher"></i> Dashboard Dosen</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-user"></i> Selamat datang, {{ $dosen->nama }}</h5>
                                <p class="mb-0">
                                    <strong>NIP:</strong> {{ $dosen->nip }} | 
                                    <strong>Pendidikan:</strong> {{ $dosen->pendidikan }} | 
                                    <strong>Status:</strong> 
                                    @if($dosen->is_aa)
                                        <span class="badge bg-success">Academic Advisor</span>
                                    @else
                                        <span class="badge bg-secondary">Non-AA</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-check fa-2x mb-2"></i>
                                    <h4>{{ $stats['availability_count'] }}</h4>
                                    <p>Ketersediaan Aktif</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-presentation fa-2x mb-2"></i>
                                    <h4>{{ $stats['jadwal_demo_count'] }}</h4>
                                    <p>Jadwal Demo</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-gavel fa-2x mb-2"></i>
                                    <h4>{{ $stats['jadwal_sidang_count'] }}</h4>
                                    <p>Jadwal Sidang</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-clock"></i> Ketersediaan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="{{ route('dosen.availability.index') }}" class="list-group-item list-group-item-action">
                                            <i class="fas fa-calendar-plus text-primary"></i> Atur Ketersediaan
                                            <span class="badge bg-primary rounded-pill float-end">{{ $stats['availability_count'] }}</span>
                                        </a>
                                        <a href="{{ route('dosen.availability.create') }}" class="list-group-item list-group-item-action">
                                            <i class="fas fa-plus text-success"></i> Tambah Ketersediaan Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-calendar-alt"></i> Jadwal</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="{{ route('dosen.jadwal.index') }}" class="list-group-item list-group-item-action">
                                            <i class="fas fa-eye text-info"></i> Lihat Semua Jadwal
                                        </a>
                                        <div class="list-group-item">
                                            <i class="fas fa-presentation text-success"></i> Demo PL
                                            <span class="badge bg-success rounded-pill float-end">{{ $stats['jadwal_demo_count'] }}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <i class="fas fa-gavel text-info"></i> Sidang Akhir
                                            <span class="badge bg-info rounded-pill float-end">{{ $stats['jadwal_sidang_count'] }}</span>
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
@endsection