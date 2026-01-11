<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use App\Models\KelompokMahasiswa;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample kelompok
        $kelompok1 = Kelompok::create([
            'nama_kelompok' => 'Kelompok Alpha',
            'status' => true,
        ]);

        // Get mahasiswa and dosen
        $mahasiswa1 = Mahasiswa::where('nim', '2021001')->first();
        $mahasiswa2 = Mahasiswa::where('nim', '2021002')->first();
        $dosen1 = Dosen::where('nip', '198501012010121001')->first();
        $dosen2 = Dosen::where('nip', '197801012005121002')->first();

        if ($mahasiswa1 && $mahasiswa2 && $dosen1 && $dosen2) {
            // Assign mahasiswa to kelompok
            KelompokMahasiswa::create([
                'kelompok_id' => $kelompok1->id,
                'mahasiswa_id' => $mahasiswa1->id,
            ]);

            KelompokMahasiswa::create([
                'kelompok_id' => $kelompok1->id,
                'mahasiswa_id' => $mahasiswa2->id,
            ]);

            // Assign dosen pembimbing
            Pembimbing::create([
                'kelompok_id' => $kelompok1->id,
                'dosen_id' => $dosen1->id,
                'is_utama' => true,
            ]);

            Pembimbing::create([
                'kelompok_id' => $kelompok1->id,
                'dosen_id' => $dosen2->id,
                'is_utama' => false,
            ]);
        }
    }
}
