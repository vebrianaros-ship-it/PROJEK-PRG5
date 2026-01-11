@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Jadwal Demo PL</h4>
                    <div>
                        <a href="{{ route('admin.jadwal-demo-pl.edit', $jadwalDemoPl->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.jadwal-demo-pl.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Kelompok:</strong></td>
                                    <td>{{ $jadwalDemoPl->kelompok->nama_kelompok }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ketua Demo:</strong></td>
                                    <td>{{ $jadwalDemoPl->ketuaDemo->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Penguji 1:</strong></td>
                                    <td>{{ $jadwalDemoPl->pengujiSatu->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Penguji 2:</strong></td>
                                    <td>{{ $jadwalDemoPl->pengujiDua->nama }}</td>
                                </tr>
                                @if($jadwalDemoPl->penguji3)
                                <tr>
                                    <td><strong>Penguji 3:</strong></td>
                                    <td>{{ $jadwalDemoPl->pengujiTiga->nama }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Tanggal:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($jadwalDemoPl->tanggal)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jam:</strong></td>
                                    <td>{{ $jadwalDemoPl->jam }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Lokasi:</strong></td>
                                    <td>{{ $jadwalDemoPl->lokasi }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($jadwalDemoPl->status == 'terjadwal')
                                            <span class="badge bg-warning">Terjadwal</span>
                                        @elseif($jadwalDemoPl->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-secondary">Menunggu</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($jadwalDemoPl->catatan)
                                <tr>
                                    <td><strong>Catatan:</strong></td>
                                    <td>{{ $jadwalDemoPl->catatan }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Anggota Kelompok:</h5>
                            <ul class="list-group">
                                @foreach($jadwalDemoPl->kelompok->mahasiswa as $mahasiswa)
                                    <li class="list-group-item">
                                        {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection