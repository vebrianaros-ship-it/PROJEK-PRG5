@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-file-alt"></i> Pendaftaran Demo PL</h4>
                    @php
                        $canCreate = !$pendaftaran->where('status', 'menunggu')->first() && 
                                    !$pendaftaran->where('status', 'disetujui')->first();
                    @endphp
                    @if($canCreate)
                        <a href="{{ route('mahasiswa.pendaftaran-demo.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Daftar Demo Baru
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Informasi Kelompok:</h6>
                        <p class="mb-0">
                            <strong>Nama Kelompok:</strong> {{ $kelompok->nama_kelompok }}<br>
                            <strong>Anggota:</strong> 
                            @foreach($kelompok->mahasiswa as $mhs)
                                {{ $mhs->nama }} ({{ $mhs->nim }}){{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </p>
                    </div>

                    @if(!$canCreate)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Perhatian:</strong> Anda sudah memiliki pendaftaran yang sedang diproses atau disetujui. 
                            Anda hanya bisa mendaftar ulang jika pendaftaran sebelumnya ditolak.
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Usulan</th>
                                    <th>Lokasi</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftaran as $index => $daftar)
                                <tr>
                                    <td>{{ $pendaftaran->firstItem() + $index }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($daftar->tanggal_usulan)->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($daftar->tanggal_usulan)->format('l') }}</small>
                                    </td>
                                    <td>{{ $daftar->lokasi }}</td>
                                    <td>
                                        @if($daftar->file_pendaftaran)
                                            <a href="{{ Storage::url($daftar->file_pendaftaran) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf"></i> Form Pendaftaran
                                            </a>
                                        @endif
                                        @if($daftar->file_revisi)
                                            <br>
                                            <a href="{{ Storage::url($daftar->file_revisi) }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-1">
                                                <i class="fas fa-file-pdf"></i> Form Revisi
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($daftar->status == 'menunggu')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($daftar->status == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $daftar->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('mahasiswa.pendaftaran-demo.show', $daftar) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($daftar->status == 'ditolak')
                                                <a href="{{ route('mahasiswa.pendaftaran-demo.edit', $daftar) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                            @if($daftar->status != 'disetujui')
                                                <form action="{{ route('mahasiswa.pendaftaran-demo.destroy', $daftar) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Yakin ingin menghapus pendaftaran ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-file-times fa-3x text-muted mb-3"></i>
                                            <h5>Belum ada pendaftaran demo</h5>
                                            <p class="text-muted">Silakan daftar demo PL untuk kelompok Anda</p>
                                            <a href="{{ route('mahasiswa.pendaftaran-demo.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Daftar Demo Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $pendaftaran->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection