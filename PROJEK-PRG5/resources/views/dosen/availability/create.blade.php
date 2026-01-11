@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-plus text-primary"></i> Tambah Ketersediaan</h2>
                    <p class="text-muted mb-0">Tambahkan jadwal ketersediaan Anda untuk penjadwalan Demo PL dan Sidang Akhir</p>
                </div>
                <a href="{{ route('dosen.availability.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Top Section: Info Cards -->
            <div class="row mb-4">
                <!-- Perhatian Penting -->
                <div class="col-lg-8">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Perhatian Penting</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-clock text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-1">Waktu Tidak Bertabrakan</h6>
                                            <p class="small text-muted mb-0">Pastikan waktu yang diinput tidak bertabrakan dengan ketersediaan yang sudah ada.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="icon-circle bg-info">
                                                <i class="fas fa-calendar-check text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-1">Untuk Penjadwalan</h6>
                                            <p class="small text-muted mb-0">Ketersediaan ini akan digunakan untuk penjadwalan Demo PL dan Sidang Akhir.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="icon-circle bg-danger">
                                                <i class="fas fa-ban text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-1">Batasan Jadwal</h6>
                                            <p class="small text-muted mb-0">Anda tidak bisa dijadwalkan di luar waktu ketersediaan yang sudah diinput.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profil Dosen -->
                <div class="col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-user-tie"></i> Profil Dosen</h5>
                        </div>
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <div class="mb-3">
                                <div class="avatar-circle mx-auto mb-3">
                                    <i class="fas fa-user-circle fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-2">{{ $dosen->nama }}</h4>
                                <p class="text-muted mb-3">NIP: {{ $dosen->nip }}</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <span class="badge bg-info px-3 py-2">{{ $dosen->pendidikan }}</span>
                                    @if($dosen->is_aa)
                                        <span class="badge bg-success px-3 py-2">Dosen AA</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section: Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Form Ketersediaan Baru</h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('dosen.availability.store') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="tanggal" class="form-label fw-bold fs-5">
                                                <i class="fas fa-calendar-day text-primary"></i> Tanggal
                                            </label>
                                            <input type="date" 
                                                   class="form-control form-control-lg @error('tanggal') is-invalid @enderror" 
                                                   id="tanggal" 
                                                   name="tanggal" 
                                                   value="{{ old('tanggal') }}"
                                                   min="{{ date('Y-m-d') }}"
                                                   required>
                                            @error('tanggal')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Pilih tanggal ketersediaan (minimal hari ini)</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label for="jam_mulai" class="form-label fw-bold fs-5">
                                                        <i class="fas fa-clock text-info"></i> Jam Mulai
                                                    </label>
                                                    <input type="time" 
                                                           class="form-control form-control-lg @error('jam_mulai') is-invalid @enderror" 
                                                           id="jam_mulai" 
                                                           name="jam_mulai" 
                                                           value="{{ old('jam_mulai') }}"
                                                           required>
                                                    @error('jam_mulai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label for="jam_selesai" class="form-label fw-bold fs-5">
                                                        <i class="fas fa-clock text-warning"></i> Jam Selesai
                                                    </label>
                                                    <input type="time" 
                                                           class="form-control form-control-lg @error('jam_selesai') is-invalid @enderror" 
                                                           id="jam_selesai" 
                                                           name="jam_selesai" 
                                                           value="{{ old('jam_selesai') }}"
                                                           required>
                                                    @error('jam_selesai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Duration Display -->
                                        <div class="mb-4">
                                            <div class="alert alert-info d-none" id="duration-info">
                                                <i class="fas fa-info-circle"></i>
                                                <strong>Durasi:</strong> <span id="duration-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label class="form-label fw-bold fs-5">
                                                <i class="fas fa-toggle-on text-success"></i> Status Ketersediaan
                                            </label>
                                            <div class="status-options">
                                                <div class="form-check form-check-card mb-3">
                                                    <input class="form-check-input" type="radio" name="status" id="bersedia" 
                                                        value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="bersedia">
                                                        <div class="card border-success status-card">
                                                            <div class="card-body text-center py-4">
                                                                <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                                                                <h5 class="text-success mb-2">Bersedia</h5>
                                                                <p class="text-muted mb-0">Saya bersedia dijadwalkan pada waktu ini</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-card">
                                                    <input class="form-check-input" type="radio" name="status" id="tidak_bersedia" 
                                                        value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="tidak_bersedia">
                                                        <div class="card border-danger status-card">
                                                            <div class="card-body text-center py-4">
                                                                <i class="fas fa-times-circle text-danger fa-3x mb-3"></i>
                                                                <h5 class="text-danger mb-2">Tidak Bersedia</h5>
                                                                <p class="text-muted mb-0">Saya tidak bersedia dijadwalkan pada waktu ini</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 justify-content-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                                        <i class="fas fa-save me-2"></i> Simpan Ketersediaan
                                    </button>
                                    <a href="{{ route('dosen.availability.index') }}" class="btn btn-outline-secondary btn-lg px-5 py-3">
                                        <i class="fas fa-times me-2"></i> Batal
                                    </a>
                                </div>
                            </form>
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
    border-radius: 12px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    font-size: 1.1rem;
    padding: 12px 16px;
}

.form-control-lg:focus, .form-select-lg:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    transform: translateY(-2px);
}

.card {
    border: none;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.card-header {
    border-radius: 20px 20px 0 0 !important;
    font-weight: 600;
    padding: 1.5rem;
}

.btn {
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.alert {
    border-radius: 12px;
    border: none;
}

.form-label {
    margin-bottom: 10px;
    color: #495057;
}

.form-text {
    font-size: 0.9rem;
    color: #6c757d;
}

.icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-check-card {
    position: relative;
}

.form-check-card .form-check-input {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 2;
    transform: scale(1.2);
}

.form-check-card .form-check-label {
    cursor: pointer;
    width: 100%;
}

.status-card {
    transition: all 0.3s ease;
    border-width: 2px;
    min-height: 150px;
}

.form-check-card input:checked + label .status-card {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.form-check-card input:checked + label .status-card.border-success {
    border-color: #28a745 !important;
    background-color: rgba(40, 167, 69, 0.1);
}

.form-check-card input:checked + label .status-card.border-danger {
    border-color: #dc3545 !important;
    background-color: rgba(220, 53, 69, 0.1);
}

.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0,0,0,0.175) !important;
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
    
    .status-options .row {
        flex-direction: column;
    }
    
    .card-body {
        padding: 1.5rem 1rem;
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