@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-tachometer-alt"></i> Admin Dashboard - PIC PKTA</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <h4>{{ $stats['total_mahasiswa'] }}</h4>
                                    <p>Total Mahasiswa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                                    <h4>{{ $stats['total_dosen'] }}</h4>
                                    <p>Total Dosen</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-friends fa-2x mb-2"></i>
                                    <h4>{{ $stats['total_kelompok'] }}</h4>
                                    <p>Total Kelompok</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-clock fa-2x mb-2"></i>
                                    <h4>{{ $stats['jadwal_demo_pending'] + $stats['jadwal_sidang_pending'] }}</h4>
                                    <p>Jadwal Pending</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-database"></i> Data Master</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="{{ route('admin.mahasiswa.index') }}" class="list-group-item list-group-item-action">
                                            <i class="fas fa-users text-primary"></i> Kelola Mahasiswa
                                            <span class="badge bg-primary rounded-pill float-end">{{ $stats['total_mahasiswa'] }}</span>
                                        </a>
                                        <a href="{{ route('admin.dosen.index') }}" class="list-group-item list-group-item-action">
                                            <i class="fas fa-chalkboard-teacher text-success"></i> Kelola Dosen
                                            <span class="badge bg-success rounded-pill float-end">{{ $stats['total_dosen'] }}</span>
                                        </a>
                                        <a href="{{ route('admin.kelompok.index') }}" class="list-group-item list-group-item-action">
                                            <i class="fas fa-user-friends text-info"></i> Kelola Kelompok
                                            <span class="badge bg-info rounded-pill float-end">{{ $stats['total_kelompok'] }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-calendar-alt"></i> Penjadwalan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="{{ route('admin.jadwal-demo.index') }}" class="list-group-item list-group-item-action">
                                            <i class="fas fa-calendar-alt text-warning"></i> Jadwal Demo PL
                                            <span class="badge bg-warning rounded-pill float-end">{{ $stats['jadwal_demo_pending'] }}</span>
                                        </a>
                                        <a href="{{ route('admin.jadwal-sidang.index') }}" class="list-group-item list-group-item-action">
                                            <i class="fas fa-calendar-check text-danger"></i> Jadwal Sidang
                                            <span class="badge bg-danger rounded-pill float-end">{{ $stats['jadwal_sidang_pending'] }}</span>
                                        </a>
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