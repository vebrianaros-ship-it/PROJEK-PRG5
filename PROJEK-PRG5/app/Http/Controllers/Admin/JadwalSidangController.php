<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalSidang;
use App\Models\Kelompok;
use App\Models\Dosen;
use Illuminate\Http\Request;

class JadwalSidangController extends Controller
{
    public function index()
    {
        $jadwalSidang = JadwalSidang::with(['kelompok.mahasiswa', 'ketuaSidang'])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->paginate(10);

        // Get kelompok yang sudah selesai demo tapi belum ada jadwal sidang
        $kelompokSiapSidang = Kelompok::whereHas('jadwalDemo', function($query) {
            $query->where('status', 'selesai');
        })->whereDoesntHave('jadwalSidang')
        ->with('mahasiswa')
        ->get();

        return view('admin.jadwal-sidang.index', compact('jadwalSidang', 'kelompokSiapSidang'));
    }

    public function create()
    {
        $kelompok = Kelompok::whereHas('jadwalDemo', function($query) {
            $query->where('status', 'selesai');
        })->whereDoesntHave('jadwalSidang')
        ->with('mahasiswa')
        ->get();

        $dosen = Dosen::where('status', true)->get();

        return view('admin.jadwal-sidang.create', compact('kelompok', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompok_id' => 'required|exists:kelompok,id',
            'tanggal' => 'required|date|after:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:255',
            'ketua_sidang' => 'required|exists:dosen,id',
        ]);

        JadwalSidang::create([
            'kelompok_id' => $request->kelompok_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'lokasi' => $request->lokasi,
            'ketua_sidang' => $request->ketua_sidang,
            'status' => 'terjadwal',
        ]);

        return redirect()->route('admin.jadwal-sidang.index')
            ->with('success', 'Jadwal sidang berhasil dibuat');
    }

    public function show(JadwalSidang $jadwalSidang)
    {
        $jadwalSidang->load(['kelompok.mahasiswa', 'ketuaSidang']);
        return view('admin.jadwal-sidang.show', compact('jadwalSidang'));
    }

    public function edit(JadwalSidang $jadwalSidang)
    {
        $kelompok = Kelompok::with('mahasiswa')->get();
        $dosen = Dosen::where('status', true)->get();

        return view('admin.jadwal-sidang.edit', compact('jadwalSidang', 'kelompok', 'dosen'));
    }

    public function update(Request $request, JadwalSidang $jadwalSidang)
    {
        $request->validate([
            'kelompok_id' => 'required|exists:kelompok,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:255',
            'ketua_sidang' => 'required|exists:dosen,id',
            'status' => 'required|in:terjadwal,selesai',
        ]);

        $jadwalSidang->update([
            'kelompok_id' => $request->kelompok_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'lokasi' => $request->lokasi,
            'ketua_sidang' => $request->ketua_sidang,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.jadwal-sidang.index')
            ->with('success', 'Jadwal sidang berhasil diupdate');
    }

    public function destroy(JadwalSidang $jadwalSidang)
    {
        $jadwalSidang->delete();

        return redirect()->route('admin.jadwal-sidang.index')
            ->with('success', 'Jadwal sidang berhasil dihapus');
    }
}
