<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::with('user')->paginate(10);
        return view('admin.dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:dosen,nip',
            'nama' => 'required|string|max:255',
            'pendidikan' => 'required|in:S1,S2,S3',
            'is_aa' => 'boolean',
            'email' => 'required|email|unique:users,email',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->nama,
            'username' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->nip), // Default password = NIP
            'role' => 'dosen',
            'status' => true,
        ]);

        // Create dosen record
        Dosen::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'pendidikan' => $request->pendidikan,
            'is_aa' => $request->has('is_aa'),
            'status' => true,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Dosen berhasil ditambahkan');
    }

    public function show(Dosen $dosen)
    {
        return view('admin.dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nip' => 'required|unique:dosen,nip,' . $dosen->id,
            'nama' => 'required|string|max:255',
            'pendidikan' => 'required|in:S1,S2,S3',
            'is_aa' => 'boolean',
            'email' => 'required|email|unique:users,email,' . $dosen->user_id,
        ]);

        // Update user
        $dosen->user->update([
            'name' => $request->nama,
            'username' => $request->nip,
            'email' => $request->email,
        ]);

        // Update dosen
        $dosen->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'pendidikan' => $request->pendidikan,
            'is_aa' => $request->has('is_aa'),
        ]);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Dosen berhasil diupdate');
    }

    public function destroy(Dosen $dosen)
    {
        // Soft delete by setting status to false
        $dosen->update(['status' => false]);
        $dosen->user->update(['status' => false]);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Dosen berhasil dinonaktifkan');
    }
}
