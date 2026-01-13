@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-plus text-warning"></i> Buat Jadwal Demo PL</h2>
                    <p class="text-muted mb-0">Buat jadwal Demo Proposal Lanjutan untuk kelompok mahasiswa</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.jadwal-demo-pl.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="header-icon bg-warning">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">Form Jadwal Demo PL</h5>
                                    <small class="text-muted">Lengkapi informasi jadwal Demo Proposal Lanjutan</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.jadwal-demo-pl.store') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Kelompok -->
                                        <div class="mb-4">
                                            <label for="kelompok_id" class="form-label">
                                                <i class="fas fa-users text-warning me-2"></i>Kelompok
                                            </label>
                                            <select class="form-select @error('kelompok_id') is-invalid @enderror" id="kelompok_id" name="kelompok_id" required>
                                                <option value="">Pilih Kelompok</option>
                                                @foreach($kelompokEligible as $kelompok)
                                                    <option value="{{ $kelompok->id }}" {{ old('kelompok_id', request('kelompok')) == $kelompok->id ? 'selected' : '' }}>
                                                        {{ $kelompok->nama_kelompok }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kelompok_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-info-circle text-warning me-1"></i>
                                                Hanya kelompok yang sudah menyelesaikan demo biasa
                                            </div>
                                        </div>

                                        <!-- Tanggal -->
                                        <div class="mb-4">
                                            <label for="tanggal" class="form-label">
                                                <i class="fas fa-calendar text-warning me-2"></i>Tanggal Demo PL
                                            </label>
                                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                                id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                            @error('tanggal')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Jam -->
                                        <div class="mb-4">
                                            <label for="jam" class="form-label">
                                                <i class="fas fa-clock text-warning me-2"></i>Waktu Demo PL
                                            </label>
                                            <input type="time" class="form-control @error('jam') is-invalid @enderror" 
                                                id="jam" name="jam" value="{{ old('jam') }}" required>
                                            @error('jam')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-info-circle text-warning me-1"></i>
                                                Waktu mulai demo PL
                                            </div>
                                        </div>

                                        <!-- Lokasi -->
                                        <div class="mb-4">
                                            <label for="lokasi" class="form-label">
                                                <i class="fas fa-map-marker-alt text-warning me-2"></i>Lokasi
                                            </label>
                                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                                id="lokasi" name="lokasi" value="{{ old('lokasi') }}" 
                                                placeholder="Contoh: Ruang Lab 1, Gedung A" required>
                                            @error('lokasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Ketua Demo -->
                                        <div class="mb-4">
                                            <label for="ketua_demo" class="form-label">
                                                <i class="fas fa-crown text-warning me-2"></i>Ketua Demo PL
                                                <span class="badge bg-warning ms-2">AA</span>
                                            </label>
                                            <select class="form-select @error('ketua_demo') is-invalid @enderror" id="ketua_demo" name="ketua_demo" required>
                                                <option value="">Pilih Ketua Demo</option>
                                                @foreach($dosenAA as $dosen)
                                                    <option value="{{ $dosen->id }}" {{ old('ketua_demo') == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ketua_demo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-info-circle text-warning me-1"></i>
                                                Hanya dosen dengan status Academic Advisor (AA)
                                            </div>
                                        </div>

                                        <!-- Penguji 1 -->
                                        <div class="mb-4">
                                            <label for="penguji1" class="form-label">
                                                <i class="fas fa-user-check text-warning me-2"></i>Penguji 1
                                            </label>
                                            <select class="form-select @error('penguji1') is-invalid @enderror" id="penguji1" name="penguji1" required>
                                                <option value="">Pilih Penguji 1</option>
                                                @foreach($dosenNonAA as $dosen)
                                                    <option value="{{ $dosen->id }}" {{ old('penguji1') == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('penguji1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Penguji 2 -->
                                        <div class="mb-4">
                                            <label for="penguji2" class="form-label">
                                                <i class="fas fa-user-check text-warning me-2"></i>Penguji 2
                                            </label>
                                            <select class="form-select @error('penguji2') is-invalid @enderror" id="penguji2" name="penguji2" required>
                                                <option value="">Pilih Penguji 2</option>
                                                @foreach($dosenNonAA as $dosen)
                                                    <option value="{{ $dosen->id }}" {{ old('penguji2') == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('penguji2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Penguji 3 -->
                                        <div class="mb-4">
                                            <label for="penguji3" class="form-label">
                                                <i class="fas fa-user-plus text-warning me-2"></i>Penguji 3
                                                <span class="badge bg-secondary ms-2">Opsional</span>
                                            </label>
                                            <select class="form-select @error('penguji3') is-invalid @enderror" id="penguji3" name="penguji3">
                                                <option value="">Pilih Penguji 3 (Opsional)</option>
                                                @foreach($dosenNonAA as $dosen)
                                                    <option value="{{ $dosen->id }}" {{ old('penguji3') == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('penguji3')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-info-circle text-warning me-1"></i>
                                                Penguji tambahan jika diperlukan
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Catatan -->
                                <div class="mb-4">
                                    <label for="catatan" class="form-label">
                                        <i class="fas fa-sticky-note text-warning me-2"></i>Catatan
                                    </label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                        id="catatan" name="catatan" rows="4" 
                                        placeholder="Tambahkan catatan khusus untuk demo PL ini (opsional)">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Preview Section -->
                                <div class="preview-section mb-4">
                                    <div class="preview-card">
                                        <div class="preview-header">
                                            <i class="fas fa-eye text-warning"></i>
                                            <span>Preview Jadwal</span>
                                        </div>
                                        <div class="preview-content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="preview-item">
                                                        <span class="preview-label">Jenis:</span>
                                                        <span class="badge bg-warning">Demo PL</span>
                                                    </div>
                                                    <div class="preview-item">
                                                        <span class="preview-label">Status:</span>
                                                        <span class="badge bg-success">Terjadwal</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="preview-item">
                                                        <span class="preview-label">Tim Penguji:</span>
                                                        <span class="text-muted">1 Ketua + 2-3 Penguji</span>
                                                    </div>
                                                    <div class="preview-item">
                                                        <span class="preview-label">Durasi:</span>
                                                        <span class="text-muted">~90 menit</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Alert -->
                                <div class="alert alert-warning border-0 shadow-sm">
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon bg-warning">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="alert-heading mb-1">Informasi Demo PL</h6>
                                            <ul class="mb-0 small">
                                                <li>Demo PL hanya untuk kelompok yang sudah selesai demo biasa</li>
                                                <li>Ketua demo harus memiliki status Academic Advisor (AA)</li>
                                                <li>Minimal 2 penguji, maksimal 3 penguji</li>
                                                <li>Durasi demo PL sekitar 90 menit</li>
                                                <li>Pastikan tidak ada konflik jadwal dengan dosen lain</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="{{ route('admin.jadwal-demo-pl.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-warning btn-lg">
                                        <i class="fas fa-save me-2"></i>Simpan Jadwal Demo PL
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
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
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

.preview-section {
    margin-top: 20px;
}

.preview-card {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    border-radius: 12px;
    padding: 20px;
    border: 2px solid #ffc107;
}

.preview-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    font-weight: 600;
    color: #856404;
}

.preview-header i {
    margin-right: 8px;
}

.preview-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.preview-label {
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

.badge {
    font-size: 0.8rem;
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
    
    .preview-section {
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

/* Warning theme focus states */
.form-control:focus:valid {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.form-select:focus:valid {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
        
        // Check for duplicate penguji
        const penguji1 = document.getElementById('penguji1').value;
        const penguji2 = document.getElementById('penguji2').value;
        const penguji3 = document.getElementById('penguji3').value;
        const ketuaDemo = document.getElementById('ketua_demo').value;
        
        const pengujiValues = [penguji1, penguji2, penguji3, ketuaDemo].filter(val => val !== '');
        const uniquePenguji = [...new Set(pengujiValues)];
        
        if (pengujiValues.length !== uniquePenguji.length) {
            e.preventDefault();
            alert('Tidak boleh ada dosen yang sama sebagai ketua demo dan penguji');
            isValid = false;
        }
        
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
    
    // Date validation - tidak boleh tanggal lampau
    const tanggalInput = document.getElementById('tanggal');
    tanggalInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if (selectedDate < today) {
            this.classList.add('is-invalid');
            this.nextElementSibling.textContent = 'Tanggal tidak boleh di masa lampau';
        } else {
            this.classList.remove('is-invalid');
        }
    });
    
    // Auto-suggest lokasi
    const lokasiInput = document.getElementById('lokasi');
    const lokasiSuggestions = [
        'Ruang Lab 1',
        'Ruang Lab 2', 
        'Ruang Lab 3',
        'Ruang Seminar A',
        'Ruang Seminar B',
        'Auditorium',
        'Ruang Kelas 101',
        'Ruang Kelas 102'
    ];
    
    lokasiInput.addEventListener('input', function() {
        // Simple autocomplete logic could be added here
        const value = this.value.toLowerCase();
        if (value.length > 2) {
            const matches = lokasiSuggestions.filter(loc => 
                loc.toLowerCase().includes(value)
            );
            // Could show dropdown with suggestions
        }
    });
    
    // Kelompok selection handler
    const kelompokSelect = document.getElementById('kelompok_id');
    kelompokSelect.addEventListener('change', function() {
        if (this.value) {
            // Could fetch kelompok details via AJAX and show preview
            console.log('Selected kelompok:', this.value);
        }
    });
});
</script>
@endsection