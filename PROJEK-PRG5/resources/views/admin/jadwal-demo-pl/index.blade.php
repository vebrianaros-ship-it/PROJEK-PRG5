@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Jadwal Demo PL (Proposal Lanjutan)</h2>
        <a href="{{ route('admin.jadwal-demo-pl.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jadwal Demo PL
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelompok</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Lokasi</th>
                            <th>Ketua Demo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwalDemoPL as $index => $jadwal)
                            <tr>
                                <td>{{ $jadwalDemoPL->firstItem() + $index }}</td>
                                <td>{{ $jadwal->kelompok->nama_kelompok }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $jadwal->jam }}</td>
                                <td>{{ $jadwal->lokasi }}</td>
                                <td>{{ $jadwal->ketuaDemo->nama }}</td>
                                <td>
                                    @if($jadwal->status == 'terjadwal')
                                        <span class="badge bg-warning">Terjadwal</span>
                                    @elseif($jadwal->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-secondary">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.jadwal-demo-pl.show', $jadwal->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.jadwal-demo-pl.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.jadwal-demo-pl.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada jadwal demo PL</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $jadwalDemoPL->links() }}
        </div>
    </div>

    @if($kelompokEligible->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5>Kelompok yang Memenuhi Syarat Demo PL</h5>
                <small class="text-muted">Kelompok yang sudah menyelesaikan demo biasa</small>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Kelompok</th>
                                <th>Anggota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelompokEligible as $kelompok)
                                <tr>
                                    <td>{{ $kelompok->nama_kelompok }}</td>
                                    <td>
                                        @foreach($kelompok->mahasiswa as $mahasiswa)
                                            <small class="d-block">{{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</small>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.jadwal-demo-pl.create', ['kelompok' => $kelompok->id]) }}" class="btn btn-primary btn-sm">
                                            Jadwalkan Demo PL
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection