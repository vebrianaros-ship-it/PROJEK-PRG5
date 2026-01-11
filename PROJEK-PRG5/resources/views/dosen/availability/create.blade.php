@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-calendar-plus"></i> Tambah Ketersediaan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dosen.availability.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                id="tanggal" name="tanggal" value="{{ old('tanggal') }}" 
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
                                        id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                        id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
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
                                    value="bersedia" {{ old('status', 'bersedia') == 'bersedia' ? 'checked' : '' }}>
                                <label class="form-check-label text-success" for="bersedia">
                                    <i class="fas fa-check-circle"></i> <strong>Bersedia</strong>
                                    <br><small>Saya bersedia untuk dijadwalkan pada waktu ini</small>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="tidak_bersedia" 
                                    value="tidak_bersedia" {{ old('status') == 'tidak_bersedia' ? 'checked' : '' }}>
                                <label class="form-check-label text-danger" for="tidak_bersedia">
                                    <i class="fas fa-times-circle"></i> <strong>Tidak Bersedia</strong>
                                    <br><small>Saya tidak bersedia untuk dijadwalkan pada waktu ini</small>
                                </label>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle"></i> Perhatian:</h6>
                            <ul class="mb-0">
                                <li>Pastikan waktu yang diinput tidak bertabrakan dengan ketersediaan yang sudah ada</li>
                                <li>Ketersediaan ini akan digunakan untuk penjadwalan Demo PL dan Sidang</li>
                                <li>Anda tidak bisa dijadwalkan di luar waktu ketersediaan yang sudah diinput</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dosen.availability.index') }}" class="btn btn-secondary">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    
    jamMulai.addEventListener('change', function() {
        if (jamSelesai.value && jamSelesai.value <= jamMulai.value) {
            jamSelesai.value = '';
        }
        jamSelesai.min = jamMulai.value;
    });
});
</script>
@endsection