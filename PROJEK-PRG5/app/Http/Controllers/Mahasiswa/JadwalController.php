<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalDemo;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $kelompok = $mahasiswa->kelompok()->first();
        
        if (!$kelompok) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum tergabung dalam kelompok manapun');
        }

        $jadwalDemo = JadwalDemo::where('kelompok_id', $kelompok->id)
            ->with(['ketuaDemo', 'pengujiSatu', 'pengujiDua', 'pengujiTiga'])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->get();

        $jadwalSidang = JadwalSidang::where('kelompok_id', $kelompok->id)
            ->with(['ketuaSidang'])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->get();

        return view('mahasiswa.jadwal.index', compact('jadwalDemo', 'jadwalSidang', 'kelompok', 'mahasiswa'));
    }
}
