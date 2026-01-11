@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-calendar-check"></i> Ketersediaan Saya</h4>
                    <a href="{{ route('dosen.availability.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Ketersediaan
                    </a>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong> Ketersediaan yang Anda input akan digunakan untuk penjadwalan Demo PL dan Sidang Akhir.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($availabilities as $index => $availability)
                                <tr>
                                    <td>{{ $availabilities->firstItem() + $index }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($availability->tanggal)->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($availability->tanggal)->format('l') }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($availability->jam_mulai)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($availability->jam_selesai)->format('H:i') }}</strong>
                                    </td>
                                    <td>
                                        @if($availability->status == 'bersedia')
                                            <span class="badge bg-success">Bersedia</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Bersedia</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('dosen.availability.edit', $availability) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dosen.availability.destroy', $availability) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Yakin ingin menghapus ketersediaan ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                            <h5>Belum ada ketersediaan</h5>
                                            <p class="text-muted">Silakan tambah ketersediaan Anda untuk penjadwalan</p>
                                            <a href="{{ route('dosen.availability.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Tambah Ketersediaan
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $availabilities->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection