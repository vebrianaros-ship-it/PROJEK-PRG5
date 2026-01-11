@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-users"></i> Detail Kelompok</h4>
                    <div>
                        <a href="{{ route('admin.kelompok.edit', $kelompok) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.kelompok.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-info-circle"></i> Informasi Kelompok</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama Kelompok:</strong></td>
                                    <td>{{ $kelompok->nama_kelompok }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($kelompok->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $kelompok->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-users"></i> Anggota Kelompok</h5>
                            @if($kelompok->mahasiswa->count() > 0)
                                <div class="list-group">
                                    @foreach($kelompok->mahasiswa as $mhs)
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">{{ $mhs->nama }}</h6>
                                            <small>{{ $mhs->nim }}</small>
                                        </div>
                                        <p class="mb-1">{{ $mhs->prodi }}</p>
                                        <small>Tingkat {{ $mhs->tingkat }}</small>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Belum ada anggota dalam kelompok ini
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5><i class="fas fa-chalkboard-teacher"></i> Dosen Pembimbing</h5>
                            @if($kelompok->pembimbing->count() > 0)
                                <div class="row">
                                    @foreach($kelompok->pembimbing as $pembimbing)
                                    <div class="col-md-6">
                                        <div class="card {{ $pembimbing->is_utama ? 'border-success' : 'border-secondary' }}">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    {{ $pembimbing->dosen->nama }}
                                                    @if($pembimbing->is_utama)
                                                        <span class="badge bg-success">Pembimbing Utama</span>
                                                    @else
                                                        <span class="badge bg-secondary">Pembimbing</span>
                                                    @endif
                                                </h6>
                                                <p class="card-text">
                                                    <strong>NIP:</strong> {{ $pembimbing->dosen->nip }}<br>
                                                    <strong>Pendidikan:</strong> {{ $pembimbing->dosen->pendidikan }}<br>
                                                    <strong>Jenis:</strong> 
                                                    @if($pembimbing->dosen->is_aa)
                                                        <span class="badge bg-success">AA</span>
                                                    @else
                                                        <span class="badge bg-secondary">Non-AA</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Belum ada dosen pembimbing untuk kelompok ini
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5><i class="fas fa-calendar-alt"></i> Riwayat Aktivitas</h5>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6>Kelompok Dibuat</h6>
                                        <p class="text-muted">{{ $kelompok->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                
                                @if($kelompok->pendaftaranDemo->count() > 0)
                                    @foreach($kelompok->pendaftaranDemo as $pendaftaran)
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-info"></div>
                                        <div class="timeline-content">
                                            <h6>Pendaftaran Demo</h6>
                                            <p>Status: 
                                                @if($pendaftaran->status == 'menunggu')
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @elseif($pendaftaran->status == 'disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </p>
                                            <p class="text-muted">{{ $pendaftaran->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif

                                @if($kelompok->jadwalDemo->count() > 0)
                                    @foreach($kelompok->jadwalDemo as $jadwal)
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary"></div>
                                        <div class="timeline-content">
                                            <h6>Jadwal Demo</h6>
                                            <p>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }} - {{ $jadwal->lokasi }}</p>
                                            <p class="text-muted">{{ $jadwal->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                    @endforeach
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
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -30px;
    top: 17px;
    width: 2px;
    height: calc(100% + 20px);
    background-color: #dee2e6;
}
</style>
@endsection