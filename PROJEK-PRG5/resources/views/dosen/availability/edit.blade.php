@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-edit text-warning"></i> Edit Ketersediaan</h2>
                    <p class="text-muted mb-0">Ubah jadwal ketersediaan Anda untuk penjadwalan Demo PL dan Sidang Akhir</p>
                </div>
                <a href="{{ route('dosen.availability.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="row">
                <!-- Form Section -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Ketersediaan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dosen.availability.update', $availability) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="tanggal" class="form-label fw-bold">
                                                <i class="fas fa-calendar-day text-primary"></i> Tanggal
                                            </label>
                                            <input type="date" 
                                                   class="form-control form-control-lg @error('tanggal') is-invalid @enderror" 
                                                   id="tanggal" 
                                                   name="tanggal" 
                                                   value="{{ old('tanggal', $availability->tanggal->format('Y-m-d')) }}"
                                                   min="{{ date('Y-m-d') }}"
                                                   required>
                                            @error('tanggal')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Pilih tanggal ketersediaan (minimal hari ini)</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-toggle-on text-success"></i> Status Ketersediaan
                                            </label>
                                            <div class="status-options">
                                                <div class="form-check form-check-card mb-3">
                                                    <input class="form-check-input" type="radio" name="status" id="bersedia" 
                                                        value="1" {{ old('status', $availability->status ? '1' : '0') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="bersedia">
                                                        <div class="card border-success">
                                                            <div class="card-body text-center py-3">
                                                                <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                                                                <h6 class="text-success mb-1">Bersedia</h6>
                                                                <small class="text-muted">Saya bersedia dijadwalkan</small>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-card">
                                                    <input class="form-check-input" type="radio" name="status" id="tidak_bersedia" 
                                                        value="0" {{ old('status', $availability->status ? '1' : '0') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="tidak_bersedia">
                                                        <div class="card border-danger">
                                                            <div class="card-body text-center py-3">
                                                                <i class="fas fa-times-circle text-danger fa-2x mb-2"></i>
                                                                <h6 class="text-danger mb-1">Tidak Bersedia</h6>
                                                                <small class="text-muted">Saya tidak bersedia dijadwalkan</small>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="jam_mulai" class="form-label fw-bold">
                                                <i class="fas fa-clock text-info"></i> Jam Mulai
                                            </label>
                                            <input type="time" 
                                                   class="form-control form-control-lg @error('jam_mulai') is-invalid @enderror" 
                                                   id="jam_mulai" 
                                                   name="jam_mulai" 
                                                   value="{{ old('jam_mulai', $availability->jam_mulai->format('H:i')) }}"
                                                   required>
                                            @error('jam_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="jam_selesai" class="form-label fw-bold">
                                                <i class="fas fa-clock text-warning"></i> Jam Selesai
                                            </label>
                                            <input type="time" 
                                                   class="form-control form-control-lg @error('jam_selesai') is-invalid @enderror" 
                                                   id="jam_selesai" 
                                                   name="jam_selesai" 
                                                   value="{{ old('jam_selesai', $availability->jam_selesai->format('H:i')) }}"
                                                   required>
                                            @error('jam_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Duration Display -->
                                <div class="mb-4">
                                    <div class="alert alert-info" id="duration-info">
                                        <i class="fas fa-info-circle"></i>
                                        <strong>Durasi:</strong> <span id="duration-text"></span>
                                    </div>
                                </div>

                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-warning btn-lg px-4">
                                        <i class="fas fa-save"></i> Update Ketersediaan
                                    </button>
                                    <a href="{{ route('dosen.availability.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="col-lg-4">
                    <!-- Current Data Info -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="fas fa-info-circle"></i> Data Saat Ini</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="text-primary"><i class="fas fa-calendar-day"></i> Tanggal</h6>
                                <p class="mb-1">{{ $availability->tanggal->format('d F Y') }}</p>
                                <small class="text-muted">{{ $availability->tanggal->format('l') }}</small>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="text-success"><i class="fas fa-clock"></i> Waktu</h6>
                                <p class="mb-0">{{ $availability->jam_mulai->format('H:i') }} - {{ $availability->jam_selesai->format('H:i') }}</p>
                                <small class="text-muted">
                                    Durasi: {{ $availability->jam_selesai->diffInMinutes($availability->jam_mulai) }} menit
                                </small>
                            </div>
                            
                            <div class="mb-0">
                                <h6 class="text-warning"><i class="fas fa-toggle-on"></i> Status</h6>
                                @if($availability->status)
                                    <span class="badge bg-success px-3 py-2">
                                        <i class="fas fa-check-circle"></i> Bersedia
                                    </span>
                                @else
                                    <span class="badge bg-danger px-3 py-2">
                                        <i class="fas fa-times-circle"></i> Tidak Bersedia
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Warning Info -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Perhatian</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-clock text-warning me-2 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">Waktu Tidak Bertabrakan</h6>
                                        <p class="small text-muted mb-0">Pastikan waktu yang diubah tidak bertabrakan dengan ketersediaan lain.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-0">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-calendar-times text-danger me-2 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">Jadwal Terkait</h6>
                                        <p class="small text-muted mb-0">Perubahan ini dapat mempengaruhi jadwal yang sudah dibuat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dosen Info -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-gradient-primary text-white">
                            <h6 class="mb-0"><i class="fas fa-user-tie"></i> Profil Dosen</h6>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <h5 class="mb-1">{{ $dosen->nama }}</h5>
                            <p class="text-muted mb-2">NIP: {{ $dosen->nip }}</p>
                            <div class="d-flex justify-content-center gap-2">
                                <span class="badge bg-info">{{ $dosen->pendidikan }}</span>
                                @if($dosen->is_aa)
                                    <span class="badge bg-success">Dosen AA</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
}

.form-control-lg, .form-select-lg {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control-lg:focus, .form-select-lg:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    transform: translateY(-1px);
}

.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    font-weight: 600;
}

.btn {
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.alert {
    border-radius: 10px;
    border: none;
}

.form-label {
    margin-bottom: 8px;
    color: #495057;
}

.form-text {
    font-size: 0.875em;
    color: #6c757d;
}

.form-check-card {
    position: relative;
}

.form-check-card .form-check-input {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 2;
}

.form-check-card .form-check-label {
    cursor: pointer;
    width: 100%;
}

.form-check-card .card {
    transition: all 0.3s ease;
    border-width: 2px;
}

.form-check-card input:checked + label .card {
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.form-check-card input:checked + label .card.border-success {
    border-color: #28a745 !important;
    background-color: rgba(40, 167, 69, 0.1);
}

.form-check-card input:checked + label .card.border-danger {
    border-color: #dc3545 !important;
    background-color: rgba(220, 53, 69, 0.1);
}

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
    
    .d-flex.gap-3 {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    const durationInfo = document.getElementById('duration-info');
    const durationText = document.getElementById('duration-text');

    function calculateDuration() {
        if (jamMulai.value && jamSelesai.value) {
            const start = new Date('2000-01-01 ' + jamMulai.value);
            const end = new Date('2000-01-01 ' + jamSelesai.value);
            
            if (end > start) {
                const diff = end - start;
                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                
                let durationStr = '';
                if (hours > 0) durationStr += hours + ' jam ';
                if (minutes > 0) durationStr += minutes + ' menit';
                
                durationText.textContent = durationStr || '0 menit';
                durationInfo.classList.remove('d-none');
            } else {
                durationInfo.classList.add('d-none');
            }
        } else {
            durationInfo.classList.add('d-none');
        }
    }

    // Calculate initial duration
    calculateDuration();

    jamMulai.addEventListener('change', function() {
        calculateDuration();
        if (jamSelesai.value && jamSelesai.value <= jamMulai.value) {
            jamSelesai.value = '';
        }
        jamSelesai.min = jamMulai.value;
    });

    jamSelesai.addEventListener('change', calculateDuration);
});
</script>
@endsection