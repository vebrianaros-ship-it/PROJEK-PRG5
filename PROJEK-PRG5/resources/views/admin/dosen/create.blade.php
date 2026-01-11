@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-user-plus"></i> Tambah Dosen</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dosen.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                                id="nip" name="nip" value="{{ old('nip') }}" required>
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                            <select class="form-select @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" required>
                                <option value="">Pilih Pendidikan</option>
                                <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                            @error('pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Email akan digunakan untuk login ke sistem</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_aa" name="is_aa" value="1" 
                                    {{ old('is_aa') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_aa">
                                    <strong>Academic Advisor (AA)</strong>
                                </label>
                                <div class="form-text">Centang jika dosen ini adalah Academic Advisor</div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Informasi:</strong> Password default adalah NIP dosen. Dosen dapat mengubah password setelah login.
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection