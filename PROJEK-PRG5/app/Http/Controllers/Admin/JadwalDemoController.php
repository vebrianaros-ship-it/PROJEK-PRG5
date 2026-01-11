<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDemo;
use App\Models\PendaftaranDemo;
use App\Models\Dosen;
use App\Models\AvailabilityDosen;
use Illuminate\Http\Request;

class JadwalDemoController extends Controller
{
    public function index()
    {
        $jadwalDemo = JadwalDemo::with(['kelompok.mahasiswa', 'ketuaDemo', 'pengujiSatu', 'pengujiDua', 'pengujiTiga'])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->paginate(10);

        $pendaftaranPending = PendaftaranDemo::where('status', 'disetujui')
            ->whereDoesntHave('kelompok.jadwalDemo')
            ->with('kelompok.mahasiswa')
            ->get();

        return view('admin.jadwal-demo.index', compact('jadwalDemo', 'pendaftaranPending'));
    }

    public function create()
    {
        $pendaftaranDemo = PendaftaranDemo::where('status', 'disetujui')
            ->whereDoesntHave('kelompok.jadwalDemo')
            ->with('kelompok.mahasiswa')
            ->get();

        $dosenAA = Dosen::where('status', true)
            ->where('is_aa', true)
            ->get();

        $dosenNonAA = Dosen::where('status', true)
            ->where('is_aa', false)
            ->get();

        return view('admin.jadwal-demo.create', compact('pendaftaranDemo', 'dosenAA', 'dosenNonAA'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompok_id' => 'required|exists:kelompok,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ketua_demo' => 'required|exists:dosen,id',
            'penguji1' => 'required|exists:dosen,id',
            'penguji2' => 'required|exists:dosen,id',
            'penguji3' => 'nullable|exists:dosen,id',
        ]);

        // Validasi ketua demo harus AA
        $ketuaDemo = Dosen::find($request->ketua_demo);
        if (!$ketuaDemo->is_aa) {
            return back()->withErrors(['ketua_demo' => 'Ketua demo harus dosen AA']);
        }

        // Validasi penguji1 harus pembimbing utama
        $kelompok = \App\Models\Kelompok::find($request->kelompok_id);
        $pembimbingUtama = $kelompok->pembimbing()->where('is_utama', true)->first();
        
        if (!$pembimbingUtama || $pembimbingUtama->dosen_id != $request->penguji1) {
            return back()->withErrors(['penguji1' => 'Penguji 1 harus dosen pembimbing utama']);
        }

        // Validasi tidak ada dosen yang sama
        $dosenIds = array_filter([$request->ketua_demo, $request->penguji1, $request->penguji2, $request->penguji3]);
        if (count($dosenIds) !== count(array_unique($dosenIds))) {
            return back()->withErrors(['penguji2' => 'Tidak boleh ada dosen yang sama']);
        }

        // Validasi availability dosen
        $tanggalJam = $request->tanggal . ' ' . $request->jam_mulai;
        foreach ($dosenIds as $dosenId) {
            $available = AvailabilityDosen::where('dosen_id', $dosenId)
                ->where('tanggal', $request->tanggal)
                ->where('jam_mulai', '<=', $request->jam_mulai)
                ->where('jam_selesai', '>', $request->jam_mulai)
                ->where('status', 'bersedia')
                ->exists();

            if (!$available) {
                $dosen = Dosen::find($dosenId);
                return back()->withErrors(['jam_mulai' => "Dosen {$dosen->nama} tidak tersedia pada waktu tersebut"]);
            }
        }

        // Validasi tidak ada jadwal bentrok untuk dosen
        foreach ($dosenIds as $dosenId) {
            $bentrok = JadwalDemo::where('tanggal', $request->tanggal)
                ->where(function($query) use ($request) {
                    $query->where(function($q) use ($request) {
                        $q->where('jam_mulai', '<', $request->jam_selesai)
                          ->where('jam_selesai', '>', $request->jam_mulai);
                    });
                })
                ->where(function($query) use ($dosenId) {
                    $query->where('ketua_demo', $dosenId)
                          ->orWhere('penguji1', $dosenId)
                          ->orWhere('penguji2', $dosenId)
                          ->orWhere('penguji3', $dosenId);
                })
                ->exists();

            if ($bentrok) {
                $dosen = Dosen::find($dosenId);
                return back()->withErrors(['jam_mulai' => "Dosen {$dosen->nama} sudah memiliki jadwal pada waktu tersebut"]);
            }
        }

        JadwalDemo::create([
            'kelompok_id' => $request->kelompok_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ketua_demo' => $request->ketua_demo,
            'penguji1' => $request->penguji1,
            'penguji2' => $request->penguji2,
            'penguji3' => $request->penguji3,
            'status' => 'terjadwal',
        ]);

        return redirect()->route('admin.jadwal-demo.index')
            ->with('success', 'Jadwal demo berhasil dibuat');
    }

    public function show(JadwalDemo $jadwalDemo)
    {
        $jadwalDemo->load(['kelompok.mahasiswa', 'ketuaDemo', 'pengujiSatu', 'pengujiDua', 'pengujiTiga']);
        return view('admin.jadwal-demo.show', compact('jadwalDemo'));
    }

    public function edit(JadwalDemo $jadwalDemo)
    {
        $dosenAA = Dosen::where('status', true)
            ->where('is_aa', true)
            ->get();

        $dosenNonAA = Dosen::where('status', true)
            ->where('is_aa', false)
            ->get();

        $jadwalDemo->load(['kelompok.mahasiswa']);

        return view('admin.jadwal-demo.edit', compact('jadwalDemo', 'dosenAA', 'dosenNonAA'));
    }

    public function update(Request $request, JadwalDemo $jadwalDemo)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ketua_demo' => 'required|exists:dosen,id',
            'penguji1' => 'required|exists:dosen,id',
            'penguji2' => 'required|exists:dosen,id',
            'penguji3' => 'nullable|exists:dosen,id',
        ]);

        // Same validations as store method...
        // (Copy validation logic from store method)

        $jadwalDemo->update([
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ketua_demo' => $request->ketua_demo,
            'penguji1' => $request->penguji1,
            'penguji2' => $request->penguji2,
            'penguji3' => $request->penguji3,
        ]);

        return redirect()->route('admin.jadwal-demo.index')
            ->with('success', 'Jadwal demo berhasil diupdate');
    }

    public function destroy(JadwalDemo $jadwalDemo)
    {
        $jadwalDemo->delete();

        return redirect()->route('admin.jadwal-demo.index')
            ->with('success', 'Jadwal demo berhasil dihapus');
    }

    public function getAvailableDosen(Request $request)
    {
        $tanggal = $request->tanggal;
        $jam_mulai = $request->jam_mulai;

        if (!$tanggal || !$jam_mulai) {
            return response()->json([]);
        }

        $availableDosen = Dosen::where('status', true)
            ->whereHas('availabilities', function($query) use ($tanggal, $jam_mulai) {
                $query->where('tanggal', $tanggal)
                      ->where('jam_mulai', '<=', $jam_mulai)
                      ->where('jam_selesai', '>', $jam_mulai)
                      ->where('status', 'bersedia');
            })
            ->whereDoesntHave('jadwalDemoAsKetua', function($query) use ($tanggal, $jam_mulai) {
                $query->where('tanggal', $tanggal)
                      ->where('jam_mulai', '<=', $jam_mulai)
                      ->where('jam_selesai', '>', $jam_mulai);
            })
            ->whereDoesntHave('jadwalDemoAsPenguji1', function($query) use ($tanggal, $jam_mulai) {
                $query->where('tanggal', $tanggal)
                      ->where('jam_mulai', '<=', $jam_mulai)
                      ->where('jam_selesai', '>', $jam_mulai);
            })
            ->whereDoesntHave('jadwalDemoAsPenguji2', function($query) use ($tanggal, $jam_mulai) {
                $query->where('tanggal', $tanggal)
                      ->where('jam_mulai', '<=', $jam_mulai)
                      ->where('jam_selesai', '>', $jam_mulai);
            })
            ->whereDoesntHave('jadwalDemoAsPenguji3', function($query) use ($tanggal, $jam_mulai) {
                $query->where('tanggal', $tanggal)
                      ->where('jam_mulai', '<=', $jam_mulai)
                      ->where('jam_selesai', '>', $jam_mulai);
            })
            ->get(['id', 'nama', 'is_aa']);

        return response()->json($availableDosen);
    }
}
