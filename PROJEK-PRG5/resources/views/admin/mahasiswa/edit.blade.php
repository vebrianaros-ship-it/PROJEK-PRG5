@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-user-edit text-primary"></i> Edit Mahasiswa</h2>
                    <p class="text-muted mb-0">Edit data mahasiswa {{ $mahasiswa->nama }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.mahasiswa.show', $mahasiswa) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="header-icon bg-primary">
                                    <i class="fas fa-user-edit"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">Form Edit Mahasiswa</h5>
                                    <small class="text-muted">Update data mahasiswa dengan benar</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.mahasiswa.update', $mahasiswa) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="nim" class="form-label">
                                                <i class="fas fa-id-card text-primary me-2"></i>NIM
                                            </label>
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                                id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" 
                                                placeholder="Contoh: 2021001001" required>
                                            @error('nim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-info-circle text-info me-1"></i>
                                                NIM akan digunakan sebagai password default jika diubah
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="nama" class="form-label">
                                                <i class="fas fa-user text-primary me-2"></i>Nama Lengkap
                                            </label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                                id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" 
                                                placeholder="Masukkan nama lengkap mahasiswa" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope text-primary me-2"></i>Email
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                id="email" name="email" value="{{ old('email', $mahasiswa->user->email ?? '') }}" 
                                                placeholder="contoh@email.com" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-info-circle text-info me-1"></i>
                                                Email akan digunakan untuk login ke sistem
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="prodi" class="form-label">
                                                <i class="fas fa-graduation-cap text-primary me-2"></i>Program Studi
                                            </label>
                                            <select class="form-select @error('prodi') is-invalid @enderror" id="prodi" name="prodi" required>
                                                <option value="">Pilih Program Studi</option>
                                                <option value="Teknik Informatika" {{ old('prodi', $mahasiswa->prodi) == 'Teknik Informatika' ? 'selected' : '' }}>
                                                    Teknik Informatika
                                                </option>
                                                <option value="Sistem Informasi" {{ old('prodi', $mahasiswa->prodi) == 'Sistem Informasi' ? 'selected' : '' }}>
                                                    Sistem Informasi
                                                </option>
                                                <option value="Teknik Komputer" {{ old('prodi', $mahasiswa->prodi) == 'Teknik Komputer' ? 'selected' : '' }}>
                                                    Teknik Komputer
                                                </option>
                                            </select>
                                            @error('prodi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="tingkat" class="form-label">
                                                <i class="fas fa-layer-group text-primary me-2"></i>Tingkat
                                            </label>
                                            <select class="form-select @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat" required>
                                                <option value="">Pilih Tingkat</option>
                                                <option value="1" {{ old('tingkat', $mahasiswa->tingkat) == '1' ? 'selected' : '' }}>Tingkat 1</option>
                                                <option value="2" {{ old('tingkat', $mahasiswa->tingkat) == '2' ? 'selected' : '' }}>Tingkat 2</option>
                                                <option value="3" {{ old('tingkat', $mahasiswa->tingkat) == '3' ? 'selected' : '' }}>Tingkat 3</option>
                                                <option value="4" {{ old('tingkat', $mahasiswa->tingkat) == '4' ? 'selected' : '' }}>Tingkat 4</option>
                                            </select>
                                            @error('tingkat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="status" class="form-label">
                                                <i class="fas fa-toggle-on text-primary me-2"></i>Status
                                            </label>
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                <option value="1" {{ old('status', $mahasiswa->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ old('status', $mahasiswa->status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status Preview -->
                                        <div class="status-preview">
                                            <div class="preview-card">
                                                <div class="preview-header">
                                                    <i class="fas fa-eye text-info"></i>
                                                    <span>Preview Status</span>
                                                </div>
                                                <div class="preview-content">
                                                    <div class="status-item">
                                                        <span class="status-label">Status Akun:</span>
                                                        <span class="badge bg-success status-badge">Aktif</span>
                                                    </div>
                                                    <div class="status-item">
                                                        <span class="status-label">Role:</span>
                                                        <span class="badge bg-info">Mahasiswa</span>
                                                    </div>
                                                    <div class="status-item">
                                                        <span class="status-label">Kelompok:</span>
                                                        <span class="text-muted">
                                                            @if($mahasiswa->kelompok->count() > 0)
                                                                {{ $mahasiswa->kelompok->first()->nama_kelompok }}
                                                                @if($mahasiswa->kelompok->count() > 1)
                                                                    (+{{ $mahasiswa->kelompok->count() - 1 }} lainnya)
                                                                @endif
                                                            @else
                                                                Belum ada kelompok
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Info Alert -->
                                <div class="alert alert-info border-0 shadow-sm">
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon bg-info">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="alert-heading mb-1">Informasi Update</h6>
                                            <ul class="mb-0 small">
                                                <li>Perubahan NIM akan mengubah password default mahasiswa</li>
                                                <li>Email harus unik dan akan digunakan untuk notifikasi sistem</li>
                                                <li>Status tidak aktif akan menonaktifkan akses mahasiswa</li>
                                                <li>Perubahan data akan tersimpan secara otomatis</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="{{ route('admin.mahasiswa.show', $mahasiswa) }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Update Mahasiswa
                                    </button>
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
/* Modern Dashboard Styles */
.card {
    border: none;
    border-radius: 15px;
    animation: fadeInUp 0.6s ease-out;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    padding: 25px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.header-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.form-label {
    font-weight: 600;
    margin-bottom: 8px;
    color: #495057;
}

.form-control, .form-select {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 12px 15px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    transform: translateY(-1px);
}

.form-control::placeholder {
    color: #adb5bd;
    font-style: italic;
}

.btn {
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
    padding: 12px 24px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-lg {
    padding: 15px 30px;
    font-size: 1.1rem;
}

.status-preview {
    margin-top: 20px;
}

.preview-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    padding: 20px;
    border: 2px solid #e9ecef;
}

.preview-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    font-weight: 600;
    color: #495057;
}

.preview-header i {
    margin-right: 8px;
}

.status-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.status-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-right: 10px;
}

.alert {
    border-radius: 12px;
    padding: 20px;
}

.alert-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.form-text {
    font-size: 0.85rem;
    margin-top: 5px;
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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
    
    .d-flex.gap-2 {
        width: 100%;
    }
    
    .d-flex.gap-2 .btn {
        flex: 1;
    }
    
    .btn-lg {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .card-header {
        padding: 20px;
    }
    
    .header-icon {
        width: 40px;
        height: 40px;
    }
    
    .status-preview {
        margin-top: 15px;
    }
}

/* Form validation styles */
.is-invalid {
    border-color: #dc3545 !important;
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Success state */
.form-control:valid:not(:placeholder-shown) {
    border-color: #28a745;
}

.form-select:valid {
    border-color: #28a745;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status preview update
    const statusSelect = document.getElementById('status');
    const statusBadge = document.querySelector('.status-badge');
    
    statusSelect.addEventListener('change', function() {
        if (this.value == '1') {
            statusBadge.textContent = 'Aktif';
            statusBadge.className = 'badge bg-success status-badge';
        } else {
            statusBadge.textContent = 'Tidak Aktif';
            statusBadge.className = 'badge bg-danger status-badge';
        }
    });
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi');
        }
    });
    
    // Real-time validation
    const inputs = document.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // NIM format validation
    const nimInput = document.getElementById('nim');
    nimInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
    
    // Email validation
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('blur', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value && !emailRegex.test(this.value)) {
            this.classList.add('is-invalid');
            this.nextElementSibling.textContent = 'Format email tidak valid';
        }
    });
});
</script>
@endsection