<?php

namespace Database\Seeders;

use App\Models\JadwalDemo;
use App\Models\JadwalSidang;
use App\Models\Kelompok;
use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some dosen
        $dosen1 = Dosen::where('nip', 'D001')->first(); // Radix Rascalia
        $dosen2 = Dosen::where('nip', 'D006')->first(); // Dr. Rida Indah Fariani
        $dosen3 = Dosen::where('nip', 'D003')->first(); // Arie Kusumawati
        $dosen4 = Dosen::where('nip', 'D010')->first(); // Rr. Kartika K. W.

        if (!$dosen1 || !$dosen2 || !$dosen3 || !$dosen4) {
            return;
        }

        // Create some kelompok first
        $kelompok1 = Kelompok::create([
            'nama_kelompok' => 'Kelompok 1 - Sistem Informasi Akademik',
            'status' => 'aktif',
        ]);

        $kelompok2 = Kelompok::create([
            'nama_kelompok' => 'Kelompok 2 - E-Commerce Platform',
            'status' => 'aktif',
        ]);

        $kelompok3 = Kelompok::create([
            'nama_kelompok' => 'Kelompok 3 - Mobile Learning App',
            'status' => 'aktif',
        ]);

        // Add mahasiswa to kelompok
        $mahasiswa1 = \App\Models\Mahasiswa::where('nim', '2021001')->first();
        $mahasiswa2 = \App\Models\Mahasiswa::where('nim', '2021002')->first();

        if ($mahasiswa1) {
            \App\Models\KelompokMahasiswa::create([
                'kelompok_id' => $kelompok1->id,
                'mahasiswa_id' => $mahasiswa1->id,
            ]);
        }

        if ($mahasiswa2) {
            \App\Models\KelompokMahasiswa::create([
                'kelompok_id' => $kelompok2->id,
                'mahasiswa_id' => $mahasiswa2->id,
            ]);
        }

        // Create jadwal demo
        JadwalDemo::create([
            'kelompok_id' => $kelompok1->id,
            'tanggal' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'ketua_demo' => $dosen1->id,
            'penguji1' => $dosen2->id,
            'penguji2' => $dosen3->id,
            'penguji3' => $dosen4->id,
            'status' => 'terjadwal',
        ]);

        JadwalDemo::create([
            'kelompok_id' => $kelompok2->id,
            'tanggal' => Carbon::now()->addDays(10)->format('Y-m-d'),
            'jam_mulai' => '10:00',
            'jam_selesai' => '12:00',
            'ketua_demo' => $dosen2->id,
            'penguji1' => $dosen1->id,
            'penguji2' => $dosen3->id,
            'penguji3' => $dosen4->id,
            'status' => 'terjadwal',
        ]);

        // Create jadwal sidang
        JadwalSidang::create([
            'kelompok_id' => $kelompok3->id,
            'tanggal' => Carbon::now()->addDays(14)->format('Y-m-d'),
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:00',
            'lokasi' => 'Ruang Sidang 1',
            'ketua_sidang' => $dosen1->id,
            'status' => 'terjadwal',
        ]);

        JadwalSidang::create([
            'kelompok_id' => $kelompok1->id,
            'tanggal' => Carbon::now()->addDays(21)->format('Y-m-d'),
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'lokasi' => 'Ruang Sidang 2',
            'ketua_sidang' => $dosen2->id,
            'status' => 'terjadwal',
        ]);
    }
}