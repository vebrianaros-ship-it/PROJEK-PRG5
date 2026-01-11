<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDemoPL;
use App\Models\JadwalDemo;
use App\Models\Kelompok;
use App\Models\Dosen;
use App\Models\AvailabilityDosen;
use Illuminate\Http\Request;

class JadwalDemoPLController extends Controller
{
    public function index()
    {
        $jadwalDemoPL = JadwalDemoPL::with(['kelompok.mahasiswa', 'ketuaDemo', 'pengujiSatu', 'pengujiDua', 'pengujiTiga'])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->paginate(10);

        // Kelompok yang sudah selesai demo biasa dan belum ada demo PL
        $kelompokEligible = Kelompok::whereHas('jadwalDemo', function($query) {
                $query->where('status', 'selesai');
            })
            ->whereDoesntHave('jadwalDemoPL')
            ->with('mahasiswa')
            ->get();

        return view('admin.jadwal-demo-pl.index', compact('jadwalDemoPL', 'kelompokEligible'));
    }

    public function create()
    {
        $kelompokEligible = Kelompok::whereHas('jadwalDemo', function($query) {
                $query->where('status', 'selesai');
            })
            ->whereDoesntHave('jadwalDemoPL')
            ->with('mahasiswa')
            ->get();

        $dosenAA = Dosen::where('status', true)
            ->where('is_aa', true)
            ->get();

        $dosenNonAA = Dosen::where('status', true)
            ->where('is_aa', false)
            ->get();

        return view('admin.jadwal-demo-pl.create', compact('kelompokEligible', 'dosenAA', 'dosenNonAA'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompok_id' => 'required|exists:kelompok,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required|date_format:H:i',
            'lokasi' => 'required|string|max:255',
            'ketua_demo' => 'required|exists:dosen,id',
            'penguji1' => 'required|exists:dosen,id',
            'penguji2' => 'required|exists:dosen,id',
            'penguji3' => 'nullable|exists:dosen,id',
            'catatan' => 'nullable|string',
        ]);

        // Validasi ketua demo harus AA
        $ketuaDemo = Dosen::find($request->ketua_demo);
        if (!$ketuaDemo->is_aa) {
            return back()->withErrors(['ketua_demo' => 'Ketua demo harus dosen AA']);
        }

        // Validasi kelompok sudah selesai demo biasa
        $kelompok = Kelompok::find($request->kelompok_id);
        $demoSelesai = JadwalDemo::where('kelompok_id', $request->kelompok_id)
            ->where('status', 'selesai')
            ->exists();

        if (!$demoSelesai) {
            return back()->withErrors(['kelompok_id' => 'Kelompok harus menyelesaikan demo biasa terlebih dahulu']);
        }

        // Validasi tidak ada dosen yang sama
        $dosenIds = array_filter([$request->ketua_demo, $request->penguji1, $request->penguji2, $request->penguji3]);
        if (count($dosenIds) !== count(array_unique($dosenIds))) {
            return back()->withErrors(['penguji2' => 'Tidak boleh ada dosen yang sama']);
        }

        // Validasi availability dosen
        foreach ($dosenIds as $dosenId) {
            $available = AvailabilityDosen::where('dosen_id', $dosenId)
                ->where('tanggal', $request->tanggal)
                ->where('jam_mulai', '<=', $request->jam)
                ->where('jam_selesai', '>', $request->jam)
                ->where('status', 'bersedia')
                ->exists();

            if (!$available) {
                $dosen = Dosen::find($dosenId);
                return back()->withErrors(['jam' => "Dosen {$dosen->nama} tidak tersedia pada waktu tersebut"]);
            }
        }

        // Validasi tidak ada jadwal bentrok untuk dosen
        foreach ($dosenIds as $dosenId) {
            $bentrok = JadwalDemoPL::where('tanggal', $request->tanggal)
                ->where('jam', $request->jam)
                ->where(function($query) use ($dosenId) {
                    $query->where('ketua_demo', $dosenId)
                          ->orWhere('penguji1', $dosenId)
                          ->orWhere('penguji2', $dosenId)
                          ->orWhere('penguji3', $dosenId);
                })
                ->exists();

            if ($bentrok) {
                $dosen = Dosen::find($dosenId);
                return back()->withErrors(['jam' => "Dosen {$dosen->nama} sudah memiliki jadwal pada waktu tersebut"]);
            }
        }

        JadwalDemoPL::create([
            'kelompok_id' => $request->kelompok_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,
            'ketua_demo' => $request->ketua_demo,
            'penguji1' => $request->penguji1,
            'penguji2' => $request->penguji2,
            'penguji3' => $request->penguji3,
            'status' => 'terjadwal',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.jadwal-demo-pl.index')
            ->with('success', 'Jadwal Demo PL berhasil dibuat');
    }

    public function show(JadwalDemoPL $jadwalDemoPl)
    {
        $jadwalDemoPl->load(['kelompok.mahasiswa', 'ketuaDemo', 'pengujiSatu', 'pengujiDua', 'pengujiTiga']);
        return view('admin.jadwal-demo-pl.show', compact('jadwalDemoPl'));
    }

    public function edit(JadwalDemoPL $jadwalDemoPl)
    {
        $dosenAA = Dosen::where('status', true)
            ->where('is_aa', true)
            ->get();

        $dosenNonAA = Dosen::where('status', true)
            ->where('is_aa', false)
            ->get();

        $jadwalDemoPl->load(['kelompok.mahasiswa']);

        return view('admin.jadwal-demo-pl.edit', compact('jadwalDemoPl', 'dosenAA', 'dosenNonAA'));
    }

    public function update(Request $request, JadwalDemoPL $jadwalDemoPl)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required|date_format:H:i',
            'lokasi' => 'required|string|max:255',
            'ketua_demo' => 'required|exists:dosen,id',
            'penguji1' => 'required|exists:dosen,id',
            'penguji2' => 'required|exists:dosen,id',
            'penguji3' => 'nullable|exists:dosen,id',
            'catatan' => 'nullable|string',
        ]);

        // Same validations as store method...
        $jadwalDemoPl->update([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,
            'ketua_demo' => $request->ketua_demo,
            'penguji1' => $request->penguji1,
            'penguji2' => $request->penguji2,
            'penguji3' => $request->penguji3,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.jadwal-demo-pl.index')
            ->with('success', 'Jadwal Demo PL berhasil diupdate');
    }

    public function destroy(JadwalDemoPL $jadwalDemoPl)
    {
        $jadwalDemoPl->delete();

        return redirect()->route('admin.jadwal-demo-pl.index')
            ->with('success', 'Jadwal Demo PL berhasil dihapus');
    }
}