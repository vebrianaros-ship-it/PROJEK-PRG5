@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-gavel text-primary"></i> Buat Jadwal Sidang Akhir</h2>
                    <p class="text-muted mb-0">Jadwalkan sidang akhir untuk kelompok yang sudah selesai demo</p>
                </div>
                <a href="{{ route('admin.jadwal-sidang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Main Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-plus"></i> Form Jadwal Sidang Akhir</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jadwal-sidang.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kelompok_id" class="form-label">
                                        <i class="fas fa-users text-primary"></i> Kelompok
                                    </label>
                                    <select class="form-select @error('kelompok_id') is-invalid @enderror" 
                                            id="kelompok_id" name="kelompok_id" required>
                                        <option value="">Pilih Kelompok</option>
                                        @foreach($kelompok as $kel)
                                        <option value="{{ $kel->id }}" {{ old('kelompok_id') == $kel->id ? 'selected' : '' }}>
                                            {{ $kel->nama_kelompok }}
                                            @if($kel->mahasiswa->count() > 0)
                                                ({{ $kel->mahasiswa->pluck('nama')->join(', ') }})
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kelompok_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Hanya kelompok yang sudah selesai demo yang dapat dijadwalkan sidang</div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">
                                        <i class="fas fa-calendar text-primary"></i> Tanggal Sidang
                                    </label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                           id="tanggal" name="tanggal" value="{{ old('tanggal') }}" 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jam_mulai" class="form-label">
                                                <i class="fas fa-clock text-primary"></i> Jam Mulai
                                            </label>
                                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" 
                                                   id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                                            @error('jam_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jam_selesai" class="form-label">
                                                <i class="fas fa-clock text-primary"></i> Jam Selesai
                                            </label>
                                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                                   id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                                            @error('jam_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">
                                        <i class="fas fa-map-marker-alt text-primary"></i> Lokasi Sidang
                                    </label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" name="lokasi" value="{{ old('lokasi') }}" 
                                           placeholder="Contoh: Ruang Sidang 1, Lab Komputer, dll" required>
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ketua_sidang" class="form-label">
                                        <i class="fas fa-gavel text-primary"></i> Ketua Sidang
                                    </label>
                                    <select class="form-select @error('ketua_sidang') is-invalid @enderror" 
                                            id="ketua_sidang" name="ketua_sidang" required>
                                        <option value="">Pilih Ketua Sidang</option>
                                        @foreach($dosen as $dsn)
                                        <option value="{{ $dsn->id }}" {{ old('ketua_sidang') == $dsn->id ? 'selected' : '' }}>
                                            {{ $dsn->nama }} - {{ $dsn->pendidikan }}
                                            @if($dsn->is_aa) (AA) @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ketua_sidang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Info Alert -->
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-info-circle fa-2x text-info me-3"></i>
                                <div>
                                    <h6 class="mb-1">Informasi Penjadwalan Sidang</h6>
                                    <p class="mb-0">Pastikan semua data sudah benar sebelum menyimpan jadwal</p>
                                </div>
                            </div>
                            <ul class="mb-0">
                                <li>Sidang hanya dapat dijadwalkan untuk kelompok yang sudah selesai demo</li>
                                <li>Tanggal sidang minimal H+1 dari hari ini</li>
                                <li>Jam selesai harus lebih besar dari jam mulai</li>
                                <li>Ketua sidang akan memimpin jalannya sidang akhir</li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jadwal-sidang.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Buat Jadwal Sidang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.form-label {
    font-weight: 600;
    margin-bottom: 8px;
}

.form-control, .form-select {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn {
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.alert {
    border-radius: 12px;
    border: none;
}

.alert-info {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(111, 66, 193, 0.1) 100%);
    border-left: 4px solid #17a2b8;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-fluid {
        padding: 15px;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }
    
    .btn-lg {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate end time (add 2 hours to start time)
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    
    jamMulai.addEventListener('change', function() {
        if (this.value) {
            const startTime = new Date('2000-01-01 ' + this.value);
            startTime.setHours(startTime.getHours() + 2);
            
            const endHours = startTime.getHours().toString().padStart(2, '0');
            const endMinutes = startTime.getMinutes().toString().padStart(2, '0');
            
            jamSelesai.value = endHours + ':' + endMinutes;
        }
    });
    
    // Validate end time is after start time
    jamSelesai.addEventListener('change', function() {
        if (jamMulai.value && this.value) {
            const startTime = new Date('2000-01-01 ' + jamMulai.value);
            const endTime = new Date('2000-01-01 ' + this.value);
            
            if (endTime <= startTime) {
                alert('Jam selesai harus lebih besar dari jam mulai');
                this.value = '';
            }
        }
    });
});
</script>
@endsection