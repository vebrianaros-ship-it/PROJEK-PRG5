<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\AvailabilityDosen;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AvailabilityController extends Controller
{
    public function index()
    {
        // Untuk sementara, gunakan dosen pertama sebagai contoh
        $dosen = \App\Models\Dosen::first();
        
        if (!$dosen) {
            return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan');
        }

        $availabilities = AvailabilityDosen::where('dosen_id', $dosen->id)
            ->where('tanggal', '>=', now()->format('Y-m-d'))
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->paginate(10);

        return view('dosen.availability.index', compact('availabilities', 'dosen'));
    }

    public function create()
    {
        $dosen = \App\Models\Dosen::first();
        
        if (!$dosen) {
            return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan');
        }

        return view('dosen.availability.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $dosen = \App\Models\Dosen::first();
        
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:bersedia,tidak_bersedia',
        ]);

        // Check for overlapping availability
        $existing = AvailabilityDosen::where('dosen_id', $dosen->id)
            ->where('tanggal', $request->tanggal)
            ->where(function($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhere(function($q) use ($request) {
                          $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                      });
            })
            ->exists();

        if ($existing) {
            return back()->withErrors(['jam_mulai' => 'Waktu yang dipilih bertabrakan dengan ketersediaan yang sudah ada']);
        }

        AvailabilityDosen::create([
            'dosen_id' => $dosen->id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('dosen.availability.index')
            ->with('success', 'Ketersediaan berhasil ditambahkan');
    }

    public function show(AvailabilityDosen $availability)
    {
        $this->authorize('view', $availability);
        return view('dosen.availability.show', compact('availability'));
    }

    public function edit(AvailabilityDosen $availability)
    {
        $dosen = \App\Models\Dosen::first();
        
        if ($availability->dosen_id !== $dosen->id) {
            abort(403, 'Unauthorized');
        }

        return view('dosen.availability.edit', compact('availability', 'dosen'));
    }

    public function update(Request $request, AvailabilityDosen $availability)
    {
        $dosen = \App\Models\Dosen::first();
        
        if ($availability->dosen_id !== $dosen->id) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:bersedia,tidak_bersedia',
        ]);

        // Check for overlapping availability (exclude current record)
        $existing = AvailabilityDosen::where('dosen_id', $dosen->id)
            ->where('id', '!=', $availability->id)
            ->where('tanggal', $request->tanggal)
            ->where(function($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhere(function($q) use ($request) {
                          $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                      });
            })
            ->exists();

        if ($existing) {
            return back()->withErrors(['jam_mulai' => 'Waktu yang dipilih bertabrakan dengan ketersediaan yang sudah ada']);
        }

        $availability->update([
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('dosen.availability.index')
            ->with('success', 'Ketersediaan berhasil diupdate');
    }

    public function destroy(AvailabilityDosen $availability)
    {
        $dosen = \App\Models\Dosen::first();
        
        if ($availability->dosen_id !== $dosen->id) {
            abort(403, 'Unauthorized');
        }

        $availability->delete();

        return redirect()->route('dosen.availability.index')
            ->with('success', 'Ketersediaan berhasil dihapus');
    }
}
