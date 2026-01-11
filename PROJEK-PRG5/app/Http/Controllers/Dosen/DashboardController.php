<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\AvailabilityDosen;
use App\Models\JadwalDemo;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Untuk sementara, gunakan dosen pertama sebagai contoh
        // Nanti bisa disesuaikan dengan sistem login yang sebenarnya
        $dosen = \App\Models\Dosen::first();
        
        if (!$dosen) {
            return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan');
        }

        $stats = [
            'availability_count' => AvailabilityDosen::where('dosen_id', $dosen->id)
                ->where('tanggal', '>=', now()->format('Y-m-d'))
                ->count(),
            'jadwal_demo_count' => JadwalDemo::where(function($query) use ($dosen) {
                $query->where('ketua_demo', $dosen->id)
                      ->orWhere('penguji1', $dosen->id)
                      ->orWhere('penguji2', $dosen->id)
                      ->orWhere('penguji3', $dosen->id);
            })->where('status', 'terjadwal')->count(),
            'jadwal_sidang_count' => JadwalSidang::where('ketua_sidang', $dosen->id)
                ->where('status', 'terjadwal')->count(),
        ];

        return view('dosen.dashboard', compact('dosen', 'stats'));
    }
}
