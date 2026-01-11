@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Jadwal Demo PL</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jadwal-demo-pl.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="kelompok_id" class="form-label">Kelompok</label>
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
                            <small class="form-text text-muted">Hanya kelompok yang sudah menyelesaikan demo biasa</small>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam</label>
                            <input type="time" class="form-control @error('jam') is-invalid @enderror" id="jam" name="jam" value="{{ old('jam') }}" required>
                            @error('jam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ketua_demo" class="form-label">Ketua Demo (AA)</label>
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
                        </div>

                        <div class="mb-3">
                            <label for="penguji1" class="form-label">Penguji 1</label>
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

                        <div class="mb-3">
                            <label for="penguji2" class="form-label">Penguji 2</label>
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

                        <div class="mb-3">
                            <label for="penguji3" class="form-label">Penguji 3 (Opsional)</label>
                            <select class="form-select @error('penguji3') is-invalid @enderror" id="penguji3" name="penguji3">
                                <option value="">Pilih Penguji 3</option>
                                @foreach($dosenNonAA as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('penguji3') == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penguji3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jadwal-demo-pl.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection