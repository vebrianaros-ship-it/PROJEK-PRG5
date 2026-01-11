@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-calendar-alt"></i> Jadwal Demo PL</h4>
                    <a href="{{ route('admin.jadwal-demo.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Jadwal Demo
                    </a>
                </div>
                <div class="card-body">
                    @if($pendaftaranPending->count() > 0)
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle"></i> Pendaftaran Menunggu Penjadwalan:</h6>
                            <ul class="mb-0">
                                @foreach($pendaftaranPending as $pendaftaran)
                                    <li>
                                        <strong>{{ $pendaftaran->kelompok->nama_kelompok }}</strong> - 
                                        Usulan: {{ \Carbon\Carbon::parse($pendaftaran->tanggal_usulan)->format('d/m/Y') }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelompok</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Lokasi</th>
                                    <th>Ketua Demo</th>
                                    <th>Penguji</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalDemo as $index => $jadwal)
                                <tr>
                                    <td>{{ $jadwalDemo->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $jadwal->kelompok->nama_kelompok }}</strong><br>
                                        <small class="text-muted">
                                            @foreach($jadwal->kelompok->mahasiswa as $mhs)
                                                {{ $mhs->nama }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </small>
                                    </td>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</strong><br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }}</small>
                                    </td>
                                    <td>{{ $jadwal->lokasi }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $jadwal->ketuaDemo->nama }}</span>
                                    </td>
                                    <td>
                                        <small>
                                            <strong>P1:</strong> {{ $jadwal->pengujiSatu->nama }}<br>
                                            <strong>P2:</strong> {{ $jadwal->pengujiDua->nama }}<br>
                                            @if($jadwal->pengujiTiga)
                                                <strong>P3:</strong> {{ $jadwal->pengujiTiga->nama }}
                                            @endif
                                        </small>
                                    </td>
                                    <td>
                                        @if($jadwal->status == 'menunggu')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($jadwal->status == 'terjadwal')
                                            <span class="badge bg-success">Terjadwal</span>
                                        @else
                                            <span class="badge bg-info">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.jadwal-demo.show', $jadwal) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.jadwal-demo.edit', $jadwal) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.jadwal-demo.destroy', $jadwal) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                            <h5>Belum ada jadwal demo</h5>
                                            <p class="text-muted">Silakan buat jadwal demo untuk kelompok yang sudah mendaftar</p>
                                            @if($pendaftaranPending->count() > 0)
                                                <a href="{{ route('admin.jadwal-demo.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Buat Jadwal Demo
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $jadwalDemo->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection