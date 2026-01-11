<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\PendaftaranDemo;
use App\Models\JadwalDemo;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        // Get kelompok mahasiswa
        $kelompok = $mahasiswa->kelompok()->first();
        
        $stats = [
            'has_kelompok' => $kelompok ? true : false,
            'kelompok_name' => $kelompok ? $kelompok->nama_kelompok : null,
            'pendaftaran_demo' => $kelompok ? PendaftaranDemo::where('kelompok_id', $kelompok->id)->latest()->first() : null,
            'jadwal_demo' => $kelompok ? JadwalDemo::where('kelompok_id', $kelompok->id)->latest()->first() : null,
            'jadwal_sidang' => $kelompok ? JadwalSidang::where('kelompok_id', $kelompok->id)->latest()->first() : null,
        ];

        return view('mahasiswa.dashboard', compact('mahasiswa', 'kelompok', 'stats'));
    }
}
