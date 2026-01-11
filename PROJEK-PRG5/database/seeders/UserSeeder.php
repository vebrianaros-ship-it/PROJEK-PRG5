<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hash password sekali saja untuk performa
        $defaultPassword = Hash::make('password123');
        
        // Create PIC PKTA (Admin)
        User::create([
            'username' => 'pic_pkta',
            'password' => $defaultPassword,
            'role' => 'pic',
            'status' => true,
        ]);

        // Create Dosen data
        $dosenData = [
            ['nip' => 'D001', 'nama' => 'Radix Rascalia, S.T., M.T', 'pendidikan' => 'S2', 'is_aa' => true],
            ['nip' => 'D002', 'nama' => 'Kristina Hutajulu, S.Kom., M.Kom', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D003', 'nama' => 'Arie Kusumawati, S.Kom., M.T.I', 'pendidikan' => 'S2', 'is_aa' => true],
            ['nip' => 'D004', 'nama' => 'Deyana Kusuma Wardani, S.Tr.Kom., M.Tr.Kom', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D005', 'nama' => 'Luthfi Atikah, S.Kom., M.Kom', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D006', 'nama' => 'Dr. Rida Indah Fariani, S.Si., M.T.I', 'pendidikan' => 'S3', 'is_aa' => true],
            ['nip' => 'D007', 'nama' => 'Timotius Victory, S.Kom., M.Kom', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D008', 'nama' => 'Sasmito Budi Utomo, S.Si., M.T.I', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D009', 'nama' => 'Eko Abdul Goffar, S.Kom., M.Kom', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D010', 'nama' => 'Rr. Kartika K. W., S.T., M.T', 'pendidikan' => 'S2', 'is_aa' => true],
            ['nip' => 'D011', 'nama' => 'Ning Ratwastuti, S.T., M.Eng', 'pendidikan' => 'S2', 'is_aa' => true],
            ['nip' => 'D012', 'nama' => 'Sisia Dika Ariyanto, S.Kom., M.Kom', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D013', 'nama' => 'Diya Namira Purba, S.Kom., M.Kom', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D014', 'nama' => 'Suhendra, S.T., M.T.I', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D015', 'nama' => 'Muhammad Ridha, S.T., M.Kom', 'pendidikan' => 'S2', 'is_aa' => false],
            ['nip' => 'D016', 'nama' => 'Eka Widya Yuliani, S.Kom', 'pendidikan' => 'S1', 'is_aa' => false],
            ['nip' => 'D017', 'nama' => 'Candra Bagus Kristanto, S.Kom', 'pendidikan' => 'S1', 'is_aa' => false],
            ['nip' => 'D018', 'nama' => 'Indah Cythia Devi, S.Kom', 'pendidikan' => 'S1', 'is_aa' => false],
        ];

        // Insert dosen (tanpa user account)
        foreach ($dosenData as $data) {
            Dosen::create($data);
        }

        // Create sample users untuk login
        $dosenUser = User::create([
            'username' => 'dosen1',
            'password' => $defaultPassword,
            'role' => 'dosen',
            'status' => true,
        ]);

        $mahasiswaUser = User::create([
            'username' => 'mahasiswa1',
            'password' => $defaultPassword,
            'role' => 'mahasiswa',
            'status' => true,
        ]);

        // Create sample Mahasiswa
        Mahasiswa::create([
            'user_id' => $mahasiswaUser->id,
            'nim' => '2021001',
            'nama' => 'Ahmad Rizki',
            'prodi' => 'Teknik Informatika',
            'tingkat' => 3,
            'status' => true,
        ]);

        Mahasiswa::create([
            'user_id' => null,
            'nim' => '2021002',
            'nama' => 'Siti Nurhaliza',
            'prodi' => 'Teknik Informatika',
            'tingkat' => 3,
            'status' => true,
        ]);
    }
}