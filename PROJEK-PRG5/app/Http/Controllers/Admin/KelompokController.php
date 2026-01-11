<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\KelompokMahasiswa;
use App\Models\Pembimbing;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    public function index()
    {
        $kelompok = Kelompok::with(['mahasiswa', 'dosen'])->paginate(10);
        return view('admin.kelompok.index', compact('kelompok'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::where('status', true)
            ->whereDoesntHave('kelompok')
            ->get();
        $dosen = Dosen::where('status', true)->get();
        
        return view('admin.kelompok.create', compact('mahasiswa', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelompok' => 'required|string|max:255|unique:kelompok,nama_kelompok',
            'mahasiswa_ids' => 'required|array|min:1|max:2',
            'mahasiswa_ids.*' => 'exists:mahasiswa,id',
            'dosen_pembimbing' => 'required|array|min:1|max:2',
            'dosen_pembimbing.*' => 'exists:dosen,id',
            'pembimbing_utama' => 'required|exists:dosen,id',
        ]);

        // Validasi pembimbing utama harus ada di dosen pembimbing
        if (!in_array($request->pembimbing_utama, $request->dosen_pembimbing)) {
            return back()->withErrors(['pembimbing_utama' => 'Pembimbing utama harus dipilih dari dosen pembimbing']);
        }

        // Create kelompok
        $kelompok = Kelompok::create([
            'nama_kelompok' => $request->nama_kelompok,
            'status' => true,
        ]);

        // Assign mahasiswa to kelompok
        foreach ($request->mahasiswa_ids as $mahasiswa_id) {
            KelompokMahasiswa::create([
                'kelompok_id' => $kelompok->id,
                'mahasiswa_id' => $mahasiswa_id,
            ]);
        }

        // Assign dosen pembimbing
        foreach ($request->dosen_pembimbing as $dosen_id) {
            Pembimbing::create([
                'kelompok_id' => $kelompok->id,
                'dosen_id' => $dosen_id,
                'is_utama' => $dosen_id == $request->pembimbing_utama,
            ]);
        }

        return redirect()->route('admin.kelompok.index')
            ->with('success', 'Kelompok berhasil dibuat');
    }

    public function show(Kelompok $kelompok)
    {
        $kelompok->load(['mahasiswa', 'dosen', 'pembimbing.dosen']);
        return view('admin.kelompok.show', compact('kelompok'));
    }

    public function edit(Kelompok $kelompok)
    {
        $mahasiswa = Mahasiswa::where('status', true)
            ->where(function($query) use ($kelompok) {
                $query->whereDoesntHave('kelompok')
                      ->orWhereHas('kelompok', function($q) use ($kelompok) {
                          $q->where('kelompok_id', $kelompok->id);
                      });
            })
            ->get();
        $dosen = Dosen::where('status', true)->get();
        
        $kelompok->load(['mahasiswa', 'dosen', 'pembimbing']);
        
        return view('admin.kelompok.edit', compact('kelompok', 'mahasiswa', 'dosen'));
    }

    public function update(Request $request, Kelompok $kelompok)
    {
        $request->validate([
            'nama_kelompok' => 'required|string|max:255|unique:kelompok,nama_kelompok,' . $kelompok->id,
            'mahasiswa_ids' => 'required|array|min:1|max:2',
            'mahasiswa_ids.*' => 'exists:mahasiswa,id',
            'dosen_pembimbing' => 'required|array|min:1|max:2',
            'dosen_pembimbing.*' => 'exists:dosen,id',
            'pembimbing_utama' => 'required|exists:dosen,id',
        ]);

        // Validasi pembimbing utama harus ada di dosen pembimbing
        if (!in_array($request->pembimbing_utama, $request->dosen_pembimbing)) {
            return back()->withErrors(['pembimbing_utama' => 'Pembimbing utama harus dipilih dari dosen pembimbing']);
        }

        // Update kelompok
        $kelompok->update([
            'nama_kelompok' => $request->nama_kelompok,
        ]);

        // Update mahasiswa
        KelompokMahasiswa::where('kelompok_id', $kelompok->id)->delete();
        foreach ($request->mahasiswa_ids as $mahasiswa_id) {
            KelompokMahasiswa::create([
                'kelompok_id' => $kelompok->id,
                'mahasiswa_id' => $mahasiswa_id,
            ]);
        }

        // Update dosen pembimbing
        Pembimbing::where('kelompok_id', $kelompok->id)->delete();
        foreach ($request->dosen_pembimbing as $dosen_id) {
            Pembimbing::create([
                'kelompok_id' => $kelompok->id,
                'dosen_id' => $dosen_id,
                'is_utama' => $dosen_id == $request->pembimbing_utama,
            ]);
        }

        return redirect()->route('admin.kelompok.index')
            ->with('success', 'Kelompok berhasil diupdate');
    }

    public function destroy(Kelompok $kelompok)
    {
        // Soft delete
        $kelompok->update(['status' => false]);

        return redirect()->route('admin.kelompok.index')
            ->with('success', 'Kelompok berhasil dinonaktifkan');
    }
}
