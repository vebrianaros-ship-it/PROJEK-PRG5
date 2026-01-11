@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-calendar-alt"></i> Jadwal Saya</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-user"></i>
                        <strong>{{ $dosen->nama }}</strong> - {{ $dosen->nip }}
                    </div>

                    <!-- Jadwal Demo -->
                    <div class="mb-4">
                        <h5><i class="fas fa-presentation"></i> Jadwal Demo PL</h5>
                        @if($jadwalDemo->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal & Waktu</th>
                                            <th>Kelompok</th>
                                            <th>Lokasi</th>
                                            <th>Peran</th>
                                            <th>Tim Penguji</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalDemo as $demo)
                                        <tr>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($demo->tanggal)->format('d/m/Y') }}</strong><br>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($demo->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($demo->jam_selesai)->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $demo->kelompok->nama_kelompok }}</strong><br>
                                                <small class="text-muted">
                                                    @foreach($demo->kelompok->mahasiswa as $mhs)
                                                        {{ $mhs->nama }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </small>
                                            </td>
                                            <td>{{ $demo->lokasi }}</td>
                                            <td>
                                                @if($demo->ketua_demo == $dosen->id)
                                                    <span class="badge bg-success">Ketua Demo</span>
                                                @elseif($demo->penguji1 == $dosen->id)
                                                    <span class="badge bg-primary">Penguji 1 (Pembimbing)</span>
                                                @elseif($demo->penguji2 == $dosen->id)
                                                    <span class="badge bg-info">Penguji 2</span>
                                                @elseif($demo->penguji3 == $dosen->id)
                                                    <span class="badge bg-secondary">Penguji 3 (Industri)</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>
                                                    <strong>Ketua:</strong> {{ $demo->ketuaDemo->nama }}<br>
                                                    <strong>P1:</strong> {{ $demo->pengujiSatu->nama }}<br>
                                                    <strong>P2:</strong> {{ $demo->pengujiDua->nama }}<br>
                                                    @if($demo->pengujiTiga)
                                                        <strong>P3:</strong> {{ $demo->pengujiTiga->nama }}
                                                    @endif
                                                </small>
                                            </td>
                                            <td>
                                                @if($demo->status == 'terjadwal')
                                                    <span class="badge bg-success">Terjadwal</span>
                                                @else
                                                    <span class="badge bg-info">{{ ucfirst($demo->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-light text-center">
                                <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                                <p class="mb-0">Belum ada jadwal demo</p>
                            </div>
                        @endif
                    </div>

                    <!-- Jadwal Sidang -->
                    <div class="mb-4">
                        <h5><i class="fas fa-gavel"></i> Jadwal Sidang Akhir</h5>
                        @if($jadwalSidang->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal & Waktu</th>
                                            <th>Kelompok</th>
                                            <th>Lokasi</th>
                                            <th>Peran</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalSidang as $sidang)
                                        <tr>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($sidang->tanggal)->format('d/m/Y') }}</strong><br>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($sidang->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($sidang->jam_selesai)->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $sidang->kelompok->nama_kelompok }}</strong><br>
                                                <small class="text-muted">
                                                    @foreach($sidang->kelompok->mahasiswa as $mhs)
                                                        {{ $mhs->nama }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </small>
                                            </td>
                                            <td>{{ $sidang->lokasi }}</td>
                                            <td>
                                                <span class="badge bg-primary">Ketua Sidang</span>
                                            </td>
                                            <td>
                                                @if($sidang->status == 'terjadwal')
                                                    <span class="badge bg-success">Terjadwal</span>
                                                    @if($sidang->is_locked)
                                                        <span class="badge bg-warning">Terkunci</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-info">{{ ucfirst($sidang->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-light text-center">
                                <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                                <p class="mb-0">Belum ada jadwal sidang</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection