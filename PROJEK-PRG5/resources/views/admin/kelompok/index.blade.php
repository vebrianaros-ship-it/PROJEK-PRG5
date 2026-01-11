@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-user-friends"></i> Data Kelompok</h4>
                    <a href="{{ route('admin.kelompok.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Kelompok
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelompok</th>
                                    <th>Anggota</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelompok as $index => $kel)
                                <tr>
                                    <td>{{ $kelompok->firstItem() + $index }}</td>
                                    <td><strong>{{ $kel->nama_kelompok }}</strong></td>
                                    <td>
                                        @foreach($kel->mahasiswa as $mhs)
                                            <span class="badge bg-info">{{ $mhs->nama }} ({{ $mhs->nim }})</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($kel->dosen as $dsn)
                                            @php
                                                $pembimbing = $kel->pembimbing->where('dosen_id', $dsn->id)->first();
                                            @endphp
                                            <span class="badge {{ $pembimbing && $pembimbing->is_utama ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $dsn->nama }}
                                                @if($pembimbing && $pembimbing->is_utama) (Utama) @endif
                                            </span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($kel->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.kelompok.show', $kel) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.kelompok.edit', $kel) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($kel->status)
                                            <form action="{{ route('admin.kelompok.destroy', $kel) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Yakin ingin menonaktifkan kelompok ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data kelompok</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $kelompok->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection