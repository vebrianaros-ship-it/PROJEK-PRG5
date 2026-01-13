@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-user-friends text-info"></i> Buat Kelompok</h2>
                    <p class="text-muted mb-0">Buat kelompok mahasiswa baru dengan pembimbing</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.kelompok.index') }}" class="btn btn-outline-secondary">
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
                                <div class="header-icon bg-info">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">Form Buat Kelompok</h5>
                                    <small class="text-muted">Lengkapi informasi kelompok dan pilih anggota serta pembimbing</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.kelompok.store') }}" method="POST">
                                @csrf
                                
                                <!-- Nama Kelompok -->
                                <div class="mb-4">
                                    <label for="nama_kelompok" class="form-label">
                                        <i class="fas fa-users text-info me-2"></i>Nama Kelompok
                                    </label>
                                    <input type="text" class="form-control @error('nama_kelompok') is-invalid @enderror" 
                                        id="nama_kelompok" name="nama_kelompok" value="{{ old('nama_kelompok') }}" 
                                        placeholder="Contoh: Kelompok 1, Tim Alpha, dll" required>
                                    @error('nama_kelompok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Anggota Kelompok -->
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-user-graduate text-info me-2"></i>Anggota Kelompok
                                        <span class="badge bg-info ms-2">1-2 mahasiswa</span>
                                    </label>
                                    @error('mahasiswa_ids')
                                        <div class="alert alert-danger">
                                            <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    
                                    <div class="selection-container">
                                        @forelse($mahasiswa as $mhs)
                                        <div class="selection-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="mahasiswa_ids[]" 
                                                    value="{{ $mhs->id }}" id="mhs_{{ $mhs->id }}"
                                                    {{ in_array($mhs->id, old('mahasiswa_ids', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mhs_{{ $mhs->id }}">
                                                    <div class="selection-content">
                                                        <div class="selection-avatar">
                                                            <i class="fas fa-user-graduate fa-lg text-primary"></i>
                                                        </div>
                                                        <div class="selection-info">
                                                            <strong>{{ $mhs->nama }}</strong>
                                                            <div class="selection-meta">
                                                                <span class="badge bg-light text-dark">{{ $mhs->nim }}</span>
                                                                <span class="badge bg-info">{{ $mhs->prodi }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="alert alert-warning">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">Tidak Ada Mahasiswa Tersedia</h6>
                                                    <p class="mb-0">Semua mahasiswa sudah tergabung dalam kelompok atau belum ada data mahasiswa.</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Dosen Pembimbing -->
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-chalkboard-teacher text-info me-2"></i>Dosen Pembimbing
                                        <span class="badge bg-info ms-2">1-2 dosen</span>
                                    </label>
                                    @error('dosen_pembimbing')
                                        <div class="alert alert-danger">
                                            <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    
                                    <div class="selection-container">
                                        @foreach($dosen as $dsn)
                                        <div class="selection-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="dosen_pembimbing[]" 
                                                    value="{{ $dsn->id }}" id="dsn_{{ $dsn->id }}"
                                                    {{ in_array($dsn->id, old('dosen_pembimbing', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="dsn_{{ $dsn->id }}">
                                                    <div class="selection-content">
                                                        <div class="selection-avatar">
                                                            <i class="fas fa-user-tie fa-lg text-success"></i>
                                                        </div>
                                                        <div class="selection-info">
                                                            <div class="d-flex align-items-center">
                                                                <strong>{{ $dsn->nama }}</strong>
                                                                @if($dsn->is_aa)
                                                                    <span class="badge bg-success ms-2">
                                                                        <i class="fas fa-crown"></i> AA
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="selection-meta">
                                                                <span class="badge bg-light text-dark">{{ $dsn->nip }}</span>
                                                                <span class="badge bg-secondary">{{ $dsn->pendidikan }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Pembimbing Utama -->
                                <div class="mb-4">
                                    <label for="pembimbing_utama" class="form-label">
                                        <i class="fas fa-crown text-info me-2"></i>Pembimbing Utama
                                    </label>
                                    <select class="form-select @error('pembimbing_utama') is-invalid @enderror" 
                                        id="pembimbing_utama" name="pembimbing_utama" required>
                                        <option value="">Pilih Pembimbing Utama</option>
                                        @foreach($dosen as $dsn)
                                        <option value="{{ $dsn->id }}" {{ old('pembimbing_utama') == $dsn->id ? 'selected' : '' }}>
                                            {{ $dsn->nama }} - {{ $dsn->pendidikan }}
                                            @if($dsn->is_aa) (AA) @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('pembimbing_utama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle text-info me-1"></i>
                                        Pembimbing utama harus dipilih dari dosen pembimbing yang sudah dicentang
                                    </div>
                                </div>

                                <!-- Info Alert -->
                                <div class="alert alert-info border-0 shadow-sm">
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon bg-info">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="alert-heading mb-1">Aturan Kelompok</h6>
                                            <ul class="mb-0 small">
                                                <li>1 kelompok berisi 1-2 mahasiswa</li>
                                                <li>1 kelompok memiliki 1-2 dosen pembimbing</li>
                                                <li>Harus ada 1 pembimbing utama</li>
                                                <li>Kelompok digunakan untuk Demo PL dan Sidang</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="{{ route('admin.kelompok.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-info btn-lg">
                                        <i class="fas fa-save me-2"></i>Buat Kelompok
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
    border-color: #17a2b8;
    box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
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

.selection-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 15px;
    margin-top: 10px;
}

.selection-item {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    padding: 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.selection-item:hover {
    border-color: #17a2b8;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.15);
}

.selection-item .form-check {
    margin: 0;
}

.selection-item .form-check-input {
    margin-top: 0;
    transform: scale(1.2);
}

.selection-item .form-check-input:checked {
    background-color: #17a2b8;
    border-color: #17a2b8;
}

.selection-item .form-check-label {
    width: 100%;
    cursor: pointer;
    margin-left: 10px;
}

.selection-content {
    display: flex;
    align-items: center;
}

.selection-avatar {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.selection-info {
    flex: 1;
}

.selection-meta {
    margin-top: 5px;
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
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
    
    .selection-container {
        grid-template-columns: 1fr;
    }
    
    .selection-content {
        flex-direction: column;
        text-align: center;
    }
    
    .selection-avatar {
        margin-right: 0;
        margin-bottom: 10px;
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
    // Limit mahasiswa selection to max 2
    const mahasiswaCheckboxes = document.querySelectorAll('input[name="mahasiswa_ids[]"]');
    mahasiswaCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('input[name="mahasiswa_ids[]"]:checked').length;
            if (checkedCount >= 2) {
                mahasiswaCheckboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.disabled = true;
                        cb.closest('.selection-item').style.opacity = '0.5';
                    }
                });
            } else {
                mahasiswaCheckboxes.forEach(cb => {
                    cb.disabled = false;
                    cb.closest('.selection-item').style.opacity = '1';
                });
            }
        });
    });

    // Limit dosen selection to max 2
    const dosenCheckboxes = document.querySelectorAll('input[name="dosen_pembimbing[]"]');
    dosenCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('input[name="dosen_pembimbing[]"]:checked').length;
            if (checkedCount >= 2) {
                dosenCheckboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.disabled = true;
                        cb.closest('.selection-item').style.opacity = '0.5';
                    }
                });
            } else {
                dosenCheckboxes.forEach(cb => {
                    cb.disabled = false;
                    cb.closest('.selection-item').style.opacity = '1';
                });
            }
            
            // Update pembimbing utama options
            updatePembimbingUtamaOptions();
        });
    });

    function updatePembimbingUtamaOptions() {
        const checkedDosen = Array.from(document.querySelectorAll('input[name="dosen_pembimbing[]"]:checked'))
            .map(cb => cb.value);
        
        const pembimbingUtamaSelect = document.getElementById('pembimbing_utama');
        const options = pembimbingUtamaSelect.querySelectorAll('option');
        
        options.forEach(option => {
            if (option.value === '') return;
            
            if (checkedDosen.includes(option.value)) {
                option.disabled = false;
                option.style.display = 'block';
            } else {
                option.disabled = true;
                option.style.display = 'none';
                if (option.selected) {
                    option.selected = false;
                }
            }
        });
        
        // Reset selection if no valid options
        if (checkedDosen.length === 0) {
            pembimbingUtamaSelect.value = '';
        }
    }
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const mahasiswaChecked = document.querySelectorAll('input[name="mahasiswa_ids[]"]:checked').length;
        const dosenChecked = document.querySelectorAll('input[name="dosen_pembimbing[]"]:checked').length;
        const pembimbingUtama = document.getElementById('pembimbing_utama').value;
        
        if (mahasiswaChecked === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 mahasiswa untuk kelompok');
            return;
        }
        
        if (dosenChecked === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 dosen pembimbing');
            return;
        }
        
        if (!pembimbingUtama) {
            e.preventDefault();
            alert('Pilih pembimbing utama');
            return;
        }
        
        const checkedDosen = Array.from(document.querySelectorAll('input[name="dosen_pembimbing[]"]:checked'))
            .map(cb => cb.value);
        
        if (!checkedDosen.includes(pembimbingUtama)) {
            e.preventDefault();
            alert('Pembimbing utama harus dipilih dari dosen pembimbing yang sudah dicentang');
            return;
        }
    });
    
    // Initialize state
    updatePembimbingUtamaOptions();
});
</script>
@endsection