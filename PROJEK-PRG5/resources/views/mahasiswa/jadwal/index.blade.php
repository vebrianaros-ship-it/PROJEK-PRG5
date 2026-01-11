@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-calendar-alt"></i> Jadwal Kelompok</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-users"></i> {{ $kelompok->nama_kelompok }}</h6>
                        <p class="mb-0">
                            <strong>Anggota:</strong> 
                            @foreach($kelompok->mahasiswa as $mhs)
                                {{ $mhs->nama }} ({{ $mhs->nim }}){{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </p>
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
                                            <th>Lokasi</th>
                                            <th>Ketua Demo</th>
                                            <th>Tim Penguji</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalDemo as $demo)
                                        <tr>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($demo->tanggal)->format('d/m/Y') }}</strong><br>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($demo->jam)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($demo->tanggal)->format('l') }}
                                                </small>
                                            </td>
                                            <td>
                                                <i class="fas fa-map-marker-alt"></i> {{ $demo->lokasi }}
                                            </td>
                                            <td>
                                                <span class="badge bg-success">{{ $demo->ketuaDemo->nama }}</span>
                                            </td>
                                            <td>
                                                <small>
                                                    <strong>Penguji 1:</strong> {{ $demo->pengujiSatu->nama }} <span class="badge bg-primary">Pembimbing</span><br>
                                                    <strong>Penguji 2:</strong> {{ $demo->pengujiDua->nama }}<br>
                                                    @if($demo->pengujiTiga)
                                                        <strong>Penguji 3:</strong> {{ $demo->pengujiTiga->nama }} <span class="badge bg-secondary">Industri</span>
                                                    @endif
                                                </small>
                                            </td>
                                            <td>
                                                @if($demo->status == 'terjadwal')
                                                    <span class="badge bg-success">Terjadwal</span>
                                                @elseif($demo->status == 'selesai')
                                                    <span class="badge bg-info">Selesai</span>
                                                @else
                                                    <span class="badge bg-warning">{{ ucfirst($demo->status) }}</span>
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
                                <h6>Belum ada jadwal demo</h6>
                                <p class="mb-0 text-muted">Jadwal demo akan muncul setelah pendaftaran disetujui dan dijadwalkan oleh PIC PKTA</p>
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
                                            <th>Lokasi</th>
                                            <th>Ketua Sidang</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalSidang as $sidang)
                                        <tr>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($sidang->tanggal)->format('d/m/Y') }}</strong><br>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($sidang->jam)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($sidang->tanggal)->format('l') }}
                                                </small>
                                            </td>
                                            <td>
                                                <i class="fas fa-map-marker-alt"></i> {{ $sidang->lokasi }}
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $sidang->ketuaSidang->nama }}</span>
                                                @if($sidang->ketuaSidang->is_aa)
                                                    <span class="badge bg-success">AA</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($sidang->status == 'terjadwal')
                                                    <span class="badge bg-success">Terjadwal</span>
                                                    @if($sidang->is_locked)
                                                        <span class="badge bg-warning">Terkunci</span>
                                                    @endif
                                                @elseif($sidang->status == 'selesai')
                                                    <span class="badge bg-info">Selesai</span>
                                                @else
                                                    <span class="badge bg-warning">{{ ucfirst($sidang->status) }}</span>
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
                                <h6>Belum ada jadwal sidang</h6>
                                <p class="mb-0 text-muted">Jadwal sidang akan dibuat setelah demo PL selesai</p>
                            </div>
                        @endif
                    </div>

                    <!-- Info Tambahan -->
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-info-circle"></i> Informasi Penting:</h6>
                        <ul class="mb-0">
                            <li>Harap hadir tepat waktu sesuai jadwal yang telah ditentukan</li>
                            <li>Siapkan semua dokumen dan materi presentasi sebelum acara</li>
                            <li>Jika ada perubahan jadwal, akan diinformasikan melalui sistem ini</li>
                            <li>Hubungi PIC PKTA jika ada kendala atau pertanyaan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection