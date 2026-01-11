<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranDemo;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PendaftaranDemoController extends Controller
{
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $kelompok = $mahasiswa->kelompok()->first();
        
        if (!$kelompok) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum tergabung dalam kelompok manapun');
        }

        $pendaftaran = PendaftaranDemo::where('kelompok_id', $kelompok->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mahasiswa.pendaftaran-demo.index', compact('pendaftaran', 'kelompok', 'mahasiswa'));
    }

    public function create()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $kelompok = $mahasiswa->kelompok()->first();
        
        if (!$kelompok) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum tergabung dalam kelompok manapun');
        }

        // Check if there's already a pending or approved registration
        $existingPendaftaran = PendaftaranDemo::where('kelompok_id', $kelompok->id)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->first();

        if ($existingPendaftaran) {
            return redirect()->route('mahasiswa.pendaftaran-demo.index')
                ->with('error', 'Anda sudah memiliki pendaftaran yang sedang diproses atau disetujui');
        }

        return view('mahasiswa.pendaftaran-demo.create', compact('kelompok', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $kelompok = $mahasiswa->kelompok()->first();

        if (!$kelompok) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum tergabung dalam kelompok manapun');
        }

        $request->validate([
            'tanggal_usulan' => 'required|date|after:' . Carbon::now()->addDays(3)->format('Y-m-d'),
            'lokasi' => 'required|string|max:255',
            'file_pendaftaran' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_revisi' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'tanggal_usulan.after' => 'Tanggal usulan harus minimal 3 hari dari sekarang (H-3)',
        ]);

        // Check if there's already a pending or approved registration
        $existingPendaftaran = PendaftaranDemo::where('kelompok_id', $kelompok->id)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->first();

        if ($existingPendaftaran) {
            return redirect()->route('mahasiswa.pendaftaran-demo.index')
                ->with('error', 'Anda sudah memiliki pendaftaran yang sedang diproses atau disetujui');
        }

        // Upload files
        $filePendaftaran = null;
        $fileRevisi = null;

        if ($request->hasFile('file_pendaftaran')) {
            $filePendaftaran = $request->file('file_pendaftaran')->store('pendaftaran-demo', 'public');
        }

        if ($request->hasFile('file_revisi')) {
            $fileRevisi = $request->file('file_revisi')->store('pendaftaran-demo', 'public');
        }

        PendaftaranDemo::create([
            'kelompok_id' => $kelompok->id,
            'tanggal_usulan' => $request->tanggal_usulan,
            'lokasi' => $request->lokasi,
            'file_pendaftaran' => $filePendaftaran,
            'file_revisi' => $fileRevisi,
            'status' => 'menunggu',
        ]);

        return redirect()->route('mahasiswa.pendaftaran-demo.index')
            ->with('success', 'Pendaftaran demo berhasil disubmit. Menunggu persetujuan dari PIC PKTA.');
    }

    public function show(PendaftaranDemo $pendaftaranDemo)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $kelompok = $mahasiswa->kelompok()->first();

        if (!$kelompok || $pendaftaranDemo->kelompok_id !== $kelompok->id) {
            abort(403, 'Unauthorized');
        }

        return view('mahasiswa.pendaftaran-demo.show', compact('pendaftaranDemo', 'kelompok', 'mahasiswa'));
    }

    public function edit(PendaftaranDemo $pendaftaranDemo)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $kelompok = $mahasiswa->kelompok()->first();

        if (!$kelompok || $pendaftaranDemo->kelompok_id !== $kelompok->id) {
            abort(403, 'Unauthorized');
        }

        if ($pendaftaranDemo->status !== 'ditolak') {
            return redirect()->route('mahasiswa.pendaftaran-demo.index')
                ->with('error', 'Hanya pendaftaran yang ditolak yang bisa diedit');
        }

        return view('mahasiswa.pendaftaran-demo.edit', compact('pendaftaranDemo', 'kelompok', 'mahasiswa'));
    }

    public function update(Request $request, PendaftaranDemo $pendaftaranDemo)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $kelompok = $mahasiswa->kelompok()->first();

        if (!$kelompok || $pendaftaranDemo->kelompok_id !== $kelompok->id) {
            abort(403, 'Unauthorized');
        }

        if ($pendaftaranDemo->status !== 'ditolak') {
            return redirect()->route('mahasiswa.pendaftaran-demo.index')
                ->with('error', 'Hanya pendaftaran yang ditolak yang bisa diedit');
        }

        $request->validate([
            'tanggal_usulan' => 'required|date|after:' . Carbon::now()->addDays(3)->format('Y-m-d'),
            'lokasi' => 'required|string|max:255',
            'file_pendaftaran' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file_revisi' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'tanggal_usulan.after' => 'Tanggal usulan harus minimal 3 hari dari sekarang (H-3)',
        ]);

        $data = [
            'tanggal_usulan' => $request->tanggal_usulan,
            'lokasi' => $request->lokasi,
            'status' => 'menunggu',
        ];

        // Upload new files if provided
        if ($request->hasFile('file_pendaftaran')) {
            // Delete old file
            if ($pendaftaranDemo->file_pendaftaran) {
                Storage::disk('public')->delete($pendaftaranDemo->file_pendaftaran);
            }
            $data['file_pendaftaran'] = $request->file('file_pendaftaran')->store('pendaftaran-demo', 'public');
        }

        if ($request->hasFile('file_revisi')) {
            // Delete old file
            if ($pendaftaranDemo->file_revisi) {
                Storage::disk('public')->delete($pendaftaranDemo->file_revisi);
            }
            $data['file_revisi'] = $request->file('file_revisi')->store('pendaftaran-demo', 'public');
        }

        $pendaftaranDemo->update($data);

        return redirect()->route('mahasiswa.pendaftaran-demo.index')
            ->with('success', 'Pendaftaran demo berhasil diupdate. Menunggu persetujuan dari PIC PKTA.');
    }

    public function destroy(PendaftaranDemo $pendaftaranDemo)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $kelompok = $mahasiswa->kelompok()->first();

        if (!$kelompok || $pendaftaranDemo->kelompok_id !== $kelompok->id) {
            abort(403, 'Unauthorized');
        }

        if ($pendaftaranDemo->status === 'disetujui') {
            return redirect()->route('mahasiswa.pendaftaran-demo.index')
                ->with('error', 'Pendaftaran yang sudah disetujui tidak bisa dihapus');
        }

        // Delete files
        if ($pendaftaranDemo->file_pendaftaran) {
            Storage::disk('public')->delete($pendaftaranDemo->file_pendaftaran);
        }
        if ($pendaftaranDemo->file_revisi) {
            Storage::disk('public')->delete($pendaftaranDemo->file_revisi);
        }

        $pendaftaranDemo->delete();

        return redirect()->route('mahasiswa.pendaftaran-demo.index')
            ->with('success', 'Pendaftaran demo berhasil dihapus');
    }
}
