@extends('layouts.bootstrap')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Jadwal Demo</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jadwal-demo.update', $jadwalDemo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $jadwalDemo->tanggal) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', $jadwalDemo->jam_mulai) }}" required>
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', $jadwalDemo->jam_selesai) }}" required>
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ketua_demo" class="form-label">Ketua Demo (AA)</label>
                            <select class="form-select @error('ketua_demo') is-invalid @enderror" id="ketua_demo" name="ketua_demo" required>
                                <option value="">Pilih Ketua Demo</option>
                                @foreach($dosenAA as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('ketua_demo', $jadwalDemo->ketua_demo) == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ketua_demo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="penguji1" class="form-label">Penguji 1 (Pembimbing Utama)</label>
                            <select class="form-select @error('penguji1') is-invalid @enderror" id="penguji1" name="penguji1" required>
                                <option value="">Pilih Penguji 1</option>
                                @foreach($dosenNonAA as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('penguji1', $jadwalDemo->penguji1) == $dosen->id ? 'selected' : '' }}>
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
                                    <option value="{{ $dosen->id }}" {{ old('penguji2', $jadwalDemo->penguji2) == $dosen->id ? 'selected' : '' }}>
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
                                    <option value="{{ $dosen->id }}" {{ old('penguji3', $jadwalDemo->penguji3) == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penguji3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jadwal-demo.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update Jadwal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection