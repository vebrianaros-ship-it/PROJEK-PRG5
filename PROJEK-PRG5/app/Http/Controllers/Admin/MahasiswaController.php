<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->paginate(10);
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tingkat' => 'required|integer|min:1|max:4',
            'email' => 'required|email|unique:users,email',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->nama,
            'username' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->nim), // Default password = NIM
            'role' => 'mahasiswa',
            'status' => true,
        ]);

        // Create mahasiswa record
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'tingkat' => $request->tingkat,
            'status' => true,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tingkat' => 'required|integer|min:1|max:4',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user_id,
        ]);

        // Update user
        $mahasiswa->user->update([
            'name' => $request->nama,
            'username' => $request->nim,
            'email' => $request->email,
        ]);

        // Update mahasiswa
        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'tingkat' => $request->tingkat,
        ]);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil diupdate');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        // Soft delete by setting status to false
        $mahasiswa->update(['status' => false]);
        $mahasiswa->user->update(['status' => false]);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil dinonaktifkan');
    }
}
