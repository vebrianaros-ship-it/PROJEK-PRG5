<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\JadwalDemo;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $dosen = auth()->user()->dosen;
        
        if (!$dosen) {
            return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan');
        }

        $jadwalDemo = JadwalDemo::where(function($query) use ($dosen) {
            $query->where('ketua_demo', $dosen->id)
                  ->orWhere('penguji1', $dosen->id)
                  ->orWhere('penguji2', $dosen->id)
                  ->orWhere('penguji3', $dosen->id);
        })
        ->with(['kelompok.mahasiswa', 'ketuaDemo', 'pengujiSatu', 'pengujiDua', 'pengujiTiga'])
        ->orderBy('tanggal')
        ->orderBy('jam')
        ->get();

        $jadwalSidang = JadwalSidang::where('ketua_sidang', $dosen->id)
            ->with(['kelompok.mahasiswa', 'ketuaSidang'])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->get();

        return view('dosen.jadwal.index', compact('jadwalDemo', 'jadwalSidang', 'dosen'));
    }
}
