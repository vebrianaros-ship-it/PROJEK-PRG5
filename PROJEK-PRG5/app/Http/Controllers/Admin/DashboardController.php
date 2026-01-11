<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Kelompok;
use App\Models\JadwalDemo;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_mahasiswa' => Mahasiswa::where('status', true)->count(),
            'total_dosen' => Dosen::where('status', true)->count(),
            'total_kelompok' => Kelompok::where('status', true)->count(),
            'jadwal_demo_pending' => JadwalDemo::where('status', 'menunggu')->count(),
            'jadwal_sidang_pending' => JadwalSidang::where('status', 'menunggu')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
