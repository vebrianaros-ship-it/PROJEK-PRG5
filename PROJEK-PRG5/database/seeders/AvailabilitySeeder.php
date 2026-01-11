<?php

namespace Database\Seeders;

use App\Models\AvailabilityDosen;
use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get dosen (using new NIP format)
        $dosen1 = Dosen::where('nip', 'D001')->first(); // Radix Rascalia
        $dosen2 = Dosen::where('nip', 'D006')->first(); // Dr. Rida Indah Fariani (AA with S3)

        if (!$dosen1 || !$dosen2) {
            return;
        }

        // Data availability untuk Radix Rascalia (Dosen 1) - status boolean true = bersedia
        $availabilityDosen1 = [
            ['tanggal' => '2026-07-07', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => true],
            ['tanggal' => '2026-07-07', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-07-07', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => true],
            ['tanggal' => '2026-07-08', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => true],
            ['tanggal' => '2026-07-08', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => true],
            ['tanggal' => '2026-07-18', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => true],
            ['tanggal' => '2026-07-18', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-08-11', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-08-11', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => true],
            ['tanggal' => '2026-08-12', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => true],
            ['tanggal' => '2026-08-12', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => true],
            ['tanggal' => '2026-08-13', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => true],
            ['tanggal' => '2026-08-13', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-08-13', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => true],
            ['tanggal' => '2026-08-14', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-08-14', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => true],
            ['tanggal' => '2026-08-15', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => true],
        ];

        // Data availability untuk Dr. Rida Indah Fariani (Dosen 2)
        $availabilityDosen2 = [
            ['tanggal' => '2026-07-07', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-07-07', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'status' => true],
            ['tanggal' => '2026-07-08', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-07-08', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'status' => true],
            ['tanggal' => '2026-07-18', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => true],
            ['tanggal' => '2026-07-18', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'status' => true],
            ['tanggal' => '2026-08-11', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => true],
            ['tanggal' => '2026-08-11', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'status' => true],
            ['tanggal' => '2026-08-12', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-08-12', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'status' => true],
            ['tanggal' => '2026-08-13', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'status' => true],
            ['tanggal' => '2026-08-14', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => true],
            ['tanggal' => '2026-08-14', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'status' => true],
            ['tanggal' => '2026-08-15', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => true],
            ['tanggal' => '2026-08-15', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => true],
            ['tanggal' => '2026-08-15', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'status' => true],
        ];

        // Insert availability untuk Radix Rascalia
        foreach ($availabilityDosen1 as $availability) {
            AvailabilityDosen::create([
                'dosen_id' => $dosen1->id,
                'tanggal' => $availability['tanggal'],
                'jam_mulai' => $availability['jam_mulai'],
                'jam_selesai' => $availability['jam_selesai'],
                'status' => $availability['status'],
            ]);
        }

        // Insert availability untuk Dr. Rida Indah Fariani
        foreach ($availabilityDosen2 as $availability) {
            AvailabilityDosen::create([
                'dosen_id' => $dosen2->id,
                'tanggal' => $availability['tanggal'],
                'jam_mulai' => $availability['jam_mulai'],
                'jam_selesai' => $availability['jam_selesai'],
                'status' => $availability['status'],
            ]);
        }

        // Add availability for other AA dosen (D003, D010, D011)
        $otherAADosen = Dosen::whereIn('nip', ['D003', 'D010', 'D011'])->get();
        
        foreach ($otherAADosen as $dosen) {
            // Tambahkan beberapa availability untuk hari-hari mendatang (untuk testing)
            $futureDates = [
                Carbon::now()->addDays(5)->format('Y-m-d'),
                Carbon::now()->addDays(7)->format('Y-m-d'),
                Carbon::now()->addDays(10)->format('Y-m-d'),
                Carbon::now()->addDays(14)->format('Y-m-d'),
            ];

            foreach ($futureDates as $date) {
                AvailabilityDosen::create([
                    'dosen_id' => $dosen->id,
                    'tanggal' => $date,
                    'jam_mulai' => '08:00',
                    'jam_selesai' => '10:00',
                    'status' => true,
                ]);

                AvailabilityDosen::create([
                    'dosen_id' => $dosen->id,
                    'tanggal' => $date,
                    'jam_mulai' => '13:00',
                    'jam_selesai' => '15:00',
                    'status' => true,
                ]);
            }
        }
    }
}