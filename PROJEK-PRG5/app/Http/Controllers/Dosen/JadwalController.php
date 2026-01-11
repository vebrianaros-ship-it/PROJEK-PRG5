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
        $user = auth()->user();
        
        // Untuk user dosen dengan username 'dosen1', gunakan dosen pertama sebagai default
        if ($user->username === 'dosen1') {
            $dosen = \App\Models\Dosen::first();
        } else {
            // Coba cari dosen berdasarkan NIP yang sama dengan username
            $dosen = \App\Models\Dosen::where('nip', $user->username)->first();
        }
        
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Data dosen tidak ditemukan. Silakan hubungi administrator.');
        }

        $jadwalDemo = JadwalDemo::where(function($query) use ($dosen) {
            $query->where('ketua_demo', $dosen->id)
                  ->orWhere('penguji1', $dosen->id)
                  ->orWhere('penguji2', $dosen->id)
                  ->orWhere('penguji3', $dosen->id);
        })
        ->with(['kelompok.mahasiswa', 'ketuaDemo', 'pengujiSatu', 'pengujiDua', 'pengujiTiga'])
        ->orderBy('tanggal')
        ->orderBy('jam_mulai')
        ->get();

        $jadwalSidang = JadwalSidang::where('ketua_sidang', $dosen->id)
            ->with(['kelompok.mahasiswa', 'ketuaSidang'])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return view('dosen.jadwal.index', compact('jadwalDemo', 'jadwalSidang', 'dosen'));
    }
}
