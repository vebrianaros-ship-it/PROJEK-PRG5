@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-chalkboard-teacher text-success"></i> Tambah Dosen</h2>
                    <p class="text-muted mb-0">Tambahkan data dosen baru ke dalam sistem</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.dosen.index') }}" class="btn btn-outline-secondary">
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
                                <div class="header-icon bg-success">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">Form Tambah Dosen</h5>
                                    <small class="text-muted">Lengkapi semua data dosen dengan benar</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.dosen.store') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="nip" class="form-label">
                                                <i class="fas fa-id-badge text-success me-2"></i>NIP
                                            </label>
                                            <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                                                id="nip" name="nip" value="{{ old('nip') }}" 
                                                placeholder="Contoh: 198501012010011001" required>
                                            @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-info-circle text-info me-1"></i>
                                                NIP akan digunakan sebagai password default
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="nama" class="form-label">
                                                <i class="fas fa-user text-success me-2"></i>Nama Lengkap
                                            </label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                                id="nama" name="nama" value="{{ old('nama') }}" 
                                                placeholder="Masukkan nama lengkap dosen" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope text-success me-2"></i>Email
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                id="email" name="email" value="{{ old('email') }}" 
                                                placeholder="contoh@dosen.ac.id" required>
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
                                            <label for="pendidikan" class="form-label">
                                                <i class="fas fa-graduation-cap text-success me-2"></i>Pendidikan Terakhir
                                            </label>
                                            <select class="form-select @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" required>
                                                <option value="">Pilih Pendidikan Terakhir</option>
                                                <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>
                                                    S1 - Sarjana
                                                </option>
                                                <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>
                                                    S2 - Magister
                                                </option>
                                                <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>
                                                    S3 - Doktor
                                                </option>
                                            </select>
                                            @error('pendidikan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">
                                                <i class="fas fa-user-tie text-success me-2"></i>Role & Status
                                            </label>
                                            <div class="role-selection">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="is_aa" name="is_aa" value="1" 
                                                        {{ old('is_aa') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_aa">
                                                        <strong>Academic Advisor (AA)</strong>
                                                    </label>
                                                </div>
                                                <div class="form-text">
                                                    <i class="fas fa-info-circle text-info me-1"></i>
                                                    AA dapat menjadi ketua demo dan sidang
                                                </div>
                                            </div>
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
                                                        <span class="badge bg-success">Aktif</span>
                                                    </div>
                                                    <div class="status-item">
                                                        <span class="status-label">Role:</span>
                                                        <span class="badge bg-info">Dosen</span>
                                                    </div>
                                                    <div class="status-item">
                                                        <span class="status-label">AA Status:</span>
                                                        <span class="badge bg-warning aa-status">Non-AA</span>
                                                    </div>
                                                    <div class="status-item">
                                                        <span class="status-label">Password Default:</span>
                                                        <span class="text-muted">NIP Dosen</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Alert -->
                                <div class="alert alert-success border-0 shadow-sm">
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon bg-success">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="alert-heading mb-1">Informasi Penting</h6>
                                            <ul class="mb-0 small">
                                                <li>Password default adalah NIP dosen</li>
                                                <li>Dosen dapat mengubah password setelah login pertama kali</li>
                                                <li>Email harus unik dan akan digunakan untuk notifikasi sistem</li>
                                                <li>Academic Advisor (AA) dapat menjadi ketua demo dan sidang</li>
                                                <li>Data dosen dapat diubah setelah disimpan</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="{{ route('admin.dosen.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-save me-2"></i>Simpan Dosen
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
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
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

.role-selection {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    padding: 20px;
    border: 2px solid #e9ecef;
}

.form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
}

.form-check-input:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
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
    // Auto-generate email from NIP
    const nipInput = document.getElementById('nip');
    const emailInput = document.getElementById('email');
    
    nipInput.addEventListener('input', function() {
        if (this.value && !emailInput.value) {
            emailInput.value = this.value + '@dosen.ac.id';
        }
    });
    
    // AA Status Toggle
    const aaCheckbox = document.getElementById('is_aa');
    const aaStatusBadge = document.querySelector('.aa-status');
    
    aaCheckbox.addEventListener('change', function() {
        if (this.checked) {
            aaStatusBadge.textContent = 'Academic Advisor';
            aaStatusBadge.className = 'badge bg-success aa-status';
        } else {
            aaStatusBadge.textContent = 'Non-AA';
            aaStatusBadge.className = 'badge bg-warning aa-status';
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
    
    // NIP format validation
    nipInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 18) {
            this.value = this.value.slice(0, 18);
        }
    });
    
    // Email validation
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