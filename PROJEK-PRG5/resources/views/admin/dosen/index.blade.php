@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-chalkboard-teacher"></i> Data Dosen</h4>
                    <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Dosen
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Pendidikan</th>
                                    <th>Jenis Dosen</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dosen as $index => $dsn)
                                <tr>
                                    <td>{{ $dosen->firstItem() + $index }}</td>
                                    <td>{{ $dsn->nip }}</td>
                                    <td>{{ $dsn->nama }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $dsn->pendidikan }}</span>
                                    </td>
                                    <td>
                                        @if($dsn->is_aa)
                                            <span class="badge bg-success">AA</span>
                                        @else
                                            <span class="badge bg-secondary">Non-AA</span>
                                        @endif
                                    </td>
                                    <td>{{ $dsn->user->email ?? '-' }}</td>
                                    <td>
                                        @if($dsn->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.dosen.show', $dsn) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.dosen.edit', $dsn) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($dsn->status)
                                            <form action="{{ route('admin.dosen.destroy', $dsn) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Yakin ingin menonaktifkan dosen ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data dosen</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $dosen->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection