@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-edit text-warning"></i> Edit Jadwal Sidang Akhir</h2>
                    <p class="text-muted mb-0">Ubah jadwal sidang akhir untuk {{ $jadwalSidang->kelompok->nama_kelompok }}</p>
                </div>
                <a href="{{ route('admin.jadwal-sidang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Main Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Jadwal Sidang Akhir</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jadwal-sidang.update', $jadwalSidang) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
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
                                        <option value="{{ $kel->id }}" 
                                                {{ (old('kelompok_id', $jadwalSidang->kelompok_id) == $kel->id) ? 'selected' : '' }}>
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
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">
                                        <i class="fas fa-calendar text-primary"></i> Tanggal Sidang
                                    </label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                           id="tanggal" name="tanggal" 
                                           value="{{ old('tanggal', $jadwalSidang->tanggal) }}" required>
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
                                                   id="jam_mulai" name="jam_mulai" 
                                                   value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwalSidang->jam_mulai)->format('H:i')) }}" required>
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
                                                   id="jam_selesai" name="jam_selesai" 
                                                   value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwalSidang->jam_selesai)->format('H:i')) }}" required>
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
                                           id="lokasi" name="lokasi" 
                                           value="{{ old('lokasi', $jadwalSidang->lokasi) }}" 
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
                                        <option value="{{ $dsn->id }}" 
                                                {{ (old('ketua_sidang', $jadwalSidang->ketua_sidang) == $dsn->id) ? 'selected' : '' }}>
                                            {{ $dsn->nama }} - {{ $dsn->pendidikan }}
                                            @if($dsn->is_aa) (AA) @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ketua_sidang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">
                                        <i class="fas fa-flag text-primary"></i> Status Sidang
                                    </label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="terjadwal" {{ (old('status', $jadwalSidang->status) == 'terjadwal') ? 'selected' : '' }}>
                                            Terjadwal
                                        </option>
                                        <option value="selesai" {{ (old('status', $jadwalSidang->status) == 'selesai') ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Current Info Alert -->
                        <div class="alert alert-warning">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-info-circle fa-2x text-warning me-3"></i>
                                <div>
                                    <h6 class="mb-1">Jadwal Sidang Saat Ini</h6>
                                    <p class="mb-0">Informasi jadwal yang sedang diedit</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Kelompok:</strong> {{ $jadwalSidang->kelompok->nama_kelompok }}<br>
                                    <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwalSidang->tanggal)->format('d F Y') }}<br>
                                    <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($jadwalSidang->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwalSidang->jam_selesai)->format('H:i') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Lokasi:</strong> {{ $jadwalSidang->lokasi }}<br>
                                    <strong>Ketua Sidang:</strong> {{ $jadwalSidang->ketuaSidang->nama }}<br>
                                    <strong>Status:</strong> 
                                    @if($jadwalSidang->status == 'terjadwal')
                                        <span class="badge bg-success">Terjadwal</span>
                                    @else
                                        <span class="badge bg-info">Selesai</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jadwal-sidang.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="fas fa-save"></i> Update Jadwal Sidang
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
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
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

.alert-warning {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(253, 126, 20, 0.1) 100%);
    border-left: 4px solid #ffc107;
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
    // Validate end time is after start time
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    
    function validateTime() {
        if (jamMulai.value && jamSelesai.value) {
            const startTime = new Date('2000-01-01 ' + jamMulai.value);
            const endTime = new Date('2000-01-01 ' + jamSelesai.value);
            
            if (endTime <= startTime) {
                alert('Jam selesai harus lebih besar dari jam mulai');
                jamSelesai.value = '';
            }
        }
    }
    
    jamMulai.addEventListener('change', validateTime);
    jamSelesai.addEventListener('change', validateTime);
});
</script>
@endsection