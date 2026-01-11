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
        // Create PIC PKTA (Admin)
        $picUser = User::create([
            'name' => 'PIC PKTA',
            'username' => 'pic_pkta',
            'email' => 'pic@pkta.ac.id',
            'password' => Hash::make('password'),
            'role' => 'pic',
            'status' => true,
        ]);

        // Create sample Dosen
        $dosenUser1 = User::create([
            'name' => 'Dr. John Doe',
            'username' => 'john_doe',
            'email' => 'john.doe@university.ac.id',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'status' => true,
        ]);

        $dosen1 = Dosen::create([
            'nip' => '198501012010121001',
            'nama' => 'Dr. John Doe',
            'pendidikan' => 'S2',
            'is_aa' => true,
            'status' => true,
            'user_id' => $dosenUser1->id,
        ]);

        $dosenUser2 = User::create([
            'name' => 'Prof. Jane Smith',
            'username' => 'jane_smith',
            'email' => 'jane.smith@university.ac.id',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'status' => true,
        ]);

        $dosen2 = Dosen::create([
            'nip' => '197801012005121002',
            'nama' => 'Prof. Jane Smith',
            'pendidikan' => 'S3',
            'is_aa' => true,
            'status' => true,
            'user_id' => $dosenUser2->id,
        ]);

        // Create sample Mahasiswa
        $mahasiswaUser1 = User::create([
            'name' => 'Ahmad Rizki',
            'username' => '2021001',
            'email' => 'ahmad.rizki@student.ac.id',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'status' => true,
        ]);

        $mahasiswa1 = Mahasiswa::create([
            'nim' => '2021001',
            'nama' => 'Ahmad Rizki',
            'prodi' => 'Teknik Informatika',
            'tingkat' => 3,
            'status' => true,
            'user_id' => $mahasiswaUser1->id,
        ]);

        $mahasiswaUser2 = User::create([
            'name' => 'Siti Nurhaliza',
            'username' => '2021002',
            'email' => 'siti.nurhaliza@student.ac.id',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'status' => true,
        ]);

        $mahasiswa2 = Mahasiswa::create([
            'nim' => '2021002',
            'nama' => 'Siti Nurhaliza',
            'prodi' => 'Teknik Informatika',
            'tingkat' => 3,
            'status' => true,
            'user_id' => $mahasiswaUser2->id,
        ]);
    }
}
