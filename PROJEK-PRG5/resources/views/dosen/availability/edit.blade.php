@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-calendar-edit"></i> Edit Ketersediaan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dosen.availability.update', $availability) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                id="tanggal" name="tanggal" value="{{ old('tanggal', $availability->tanggal->format('Y-m-d')) }}" 
                                min="{{ date('Y-m-d') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                    <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" 
                                        id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', $availability->jam_mulai->format('H:i')) }}" required>
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                        id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', $availability->jam_selesai->format('H:i')) }}" required>
                                    @error('jam_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Ketersediaan</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="bersedia" 
                                    value="bersedia" {{ old('status', $availability->status) == 'bersedia' ? 'checked' : '' }}>
                                <label class="form-check-label text-success" for="bersedia">
                                    <i class="fas fa-check-circle"></i> <strong>Bersedia</strong>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="tidak_bersedia" 
                                    value="tidak_bersedia" {{ old('status', $availability->status) == 'tidak_bersedia' ? 'checked' : '' }}>
                                <label class="form-check-label text-danger" for="tidak_bersedia">
                                    <i class="fas fa-times-circle"></i> <strong>Tidak Bersedia</strong>
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dosen.availability.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection