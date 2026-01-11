@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Jadwal Demo</h4>
                    <div>
                        <a href="{{ route('admin.jadwal-demo.edit', $jadwalDemo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.jadwal-demo.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Kelompok:</strong></td>
                                    <td>{{ $jadwalDemo->kelompok->nama_kelompok }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ketua Demo:</strong></td>
                                    <td>{{ $jadwalDemo->ketuaDemo->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Penguji 1:</strong></td>
                                    <td>{{ $jadwalDemo->pengujiSatu->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Penguji 2:</strong></td>
                                    <td>{{ $jadwalDemo->pengujiDua->nama }}</td>
                                </tr>
                                @if($jadwalDemo->penguji3)
                                <tr>
                                    <td><strong>Penguji 3:</strong></td>
                                    <td>{{ $jadwalDemo->pengujiTiga->nama }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Tanggal:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($jadwalDemo->tanggal)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jam:</strong></td>
                                    <td>{{ $jadwalDemo->jam_mulai }} - {{ $jadwalDemo->jam_selesai }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($jadwalDemo->status == 'terjadwal')
                                            <span class="badge bg-warning">Terjadwal</span>
                                        @elseif($jadwalDemo->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-secondary">Menunggu</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Anggota Kelompok:</h5>
                            <ul class="list-group">
                                @foreach($jadwalDemo->kelompok->mahasiswa as $mahasiswa)
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