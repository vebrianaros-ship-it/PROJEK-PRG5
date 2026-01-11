@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-file-upload"></i> Pendaftaran Demo PL</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-users"></i> Kelompok: {{ $kelompok->nama_kelompok }}</h6>
                        <p class="mb-0">
                            <strong>Anggota:</strong> 
                            @foreach($kelompok->mahasiswa as $mhs)
                                {{ $mhs->nama }} ({{ $mhs->nim }}){{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </p>
                    </div>

                    <form action="{{ route('mahasiswa.pendaftaran-demo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="tanggal_usulan" class="form-label">Tanggal Usulan Demo</label>
                            <input type="date" class="form-control @error('tanggal_usulan') is-invalid @enderror" 
                                id="tanggal_usulan" name="tanggal_usulan" value="{{ old('tanggal_usulan') }}" 
                                min="{{ \Carbon\Carbon::now()->addDays(3)->format('Y-m-d') }}" required>
                            @error('tanggal_usulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                Tanggal usulan harus minimal 3 hari dari sekarang (H-3)
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi Demo</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                id="lokasi" name="lokasi" value="{{ old('lokasi') }}" 
                                placeholder="Contoh: Lab Komputer 1, Ruang Seminar, dll" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file_pendaftaran" class="form-label">Form Pendaftaran Demo <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('file_pendaftaran') is-invalid @enderror" 
                                id="file_pendaftaran" name="file_pendaftaran" accept=".pdf,.doc,.docx" required>
                            @error('file_pendaftaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Format: PDF, DOC, DOCX. Maksimal 2MB.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file_revisi" class="form-label">Form Revisi Seminar (Opsional)</label>
                            <input type="file" class="form-control @error('file_revisi') is-invalid @enderror" 
                                id="file_revisi" name="file_revisi" accept=".pdf,.doc,.docx">
                            @error('file_revisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Format: PDF, DOC, DOCX. Maksimal 2MB. Upload jika ada revisi dari seminar sebelumnya.
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle"></i> Perhatian:</h6>
                            <ul class="mb-0">
                                <li>Pastikan semua dokumen sudah lengkap dan benar</li>
                                <li>Tanggal usulan harus minimal 3 hari dari sekarang</li>
                                <li>Jika ingin mengubah jadwal, Anda wajib daftar ulang</li>
                                <li>Pendaftaran akan diproses oleh PIC PKTA</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('mahasiswa.pendaftaran-demo.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to 3 days from now
    const today = new Date();
    const minDate = new Date(today.getTime() + (3 * 24 * 60 * 60 * 1000));
    const minDateString = minDate.toISOString().split('T')[0];
    
    document.getElementById('tanggal_usulan').min = minDateString;
});
</script>
@endsection