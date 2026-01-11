@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Buat Kelompok Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kelompok.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nama_kelompok" class="form-label">Nama Kelompok</label>
                            <input type="text" class="form-control @error('nama_kelompok') is-invalid @enderror" 
                                id="nama_kelompok" name="nama_kelompok" value="{{ old('nama_kelompok') }}" 
                                placeholder="Contoh: Kelompok 1, Tim Alpha, dll" required>
                            @error('nama_kelompok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Anggota Kelompok (1-2 mahasiswa)</label>
                            @error('mahasiswa_ids')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="row">
                                @forelse($mahasiswa as $mhs)
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="mahasiswa_ids[]" 
                                            value="{{ $mhs->id }}" id="mhs_{{ $mhs->id }}"
                                            {{ in_array($mhs->id, old('mahasiswa_ids', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mhs_{{ $mhs->id }}">
                                            <strong>{{ $mhs->nama }}</strong><br>
                                            <small class="text-muted">{{ $mhs->nim }} - {{ $mhs->prodi }}</small>
                                        </label>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Tidak ada mahasiswa yang tersedia. Semua mahasiswa sudah tergabung dalam kelompok.
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dosen Pembimbing (1-2 dosen)</label>
                            @error('dosen_pembimbing')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="row">
                                @foreach($dosen as $dsn)
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dosen_pembimbing[]" 
                                            value="{{ $dsn->id }}" id="dsn_{{ $dsn->id }}"
                                            {{ in_array($dsn->id, old('dosen_pembimbing', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dsn_{{ $dsn->id }}">
                                            <strong>{{ $dsn->nama }}</strong>
                                            @if($dsn->is_aa)
                                                <span class="badge bg-success">AA</span>
                                            @endif
                                            <br>
                                            <small class="text-muted">{{ $dsn->nip }} - {{ $dsn->pendidikan }}</small>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pembimbing_utama" class="form-label">Pembimbing Utama</label>
                            @error('pembimbing_utama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <select class="form-select" id="pembimbing_utama" name="pembimbing_utama" required>
                                <option value="">Pilih Pembimbing Utama</option>
                                @foreach($dosen as $dsn)
                                <option value="{{ $dsn->id }}" {{ old('pembimbing_utama') == $dsn->id ? 'selected' : '' }}>
                                    {{ $dsn->nama }} - {{ $dsn->pendidikan }}
                                    @if($dsn->is_aa) (AA) @endif
                                </option>
                                @endforeach
                            </select>
                            <div class="form-text">Pembimbing utama harus dipilih dari dosen pembimbing yang sudah dicentang</div>
                        </div>

                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Aturan Kelompok:</h6>
                            <ul class="mb-0">
                                <li>1 kelompok berisi 1-2 mahasiswa</li>
                                <li>1 kelompok memiliki 1-2 dosen pembimbing</li>
                                <li>Harus ada 1 pembimbing utama</li>
                                <li>Kelompok digunakan untuk Demo PL dan Sidang</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kelompok.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Buat Kelompok
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
    // Limit mahasiswa selection to max 2
    const mahasiswaCheckboxes = document.querySelectorAll('input[name="mahasiswa_ids[]"]');
    mahasiswaCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('input[name="mahasiswa_ids[]"]:checked').length;
            if (checkedCount >= 2) {
                mahasiswaCheckboxes.forEach(cb => {
                    if (!cb.checked) cb.disabled = true;
                });
            } else {
                mahasiswaCheckboxes.forEach(cb => cb.disabled = false);
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
                    if (!cb.checked) cb.disabled = true;
                });
            } else {
                dosenCheckboxes.forEach(cb => cb.disabled = false);
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
            } else {
                option.disabled = true;
                if (option.selected) {
                    option.selected = false;
                }
            }
        });
    }
});
</script>
@endsection