<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDemoPL extends Model
{
    use HasFactory;

    protected $table = 'jadwal_demo_pl';

    protected $fillable = [
        'kelompok_id',
        'tanggal',
        'jam',
        'lokasi',
        'ketua_demo',
        'penguji1',
        'penguji2',
        'penguji3',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relationships
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    public function ketuaDemo()
    {
        return $this->belongsTo(Dosen::class, 'ketua_demo');
    }

    public function pengujiSatu()
    {
        return $this->belongsTo(Dosen::class, 'penguji1');
    }

    public function pengujiDua()
    {
        return $this->belongsTo(Dosen::class, 'penguji2');
    }

    public function pengujiTiga()
    {
        return $this->belongsTo(Dosen::class, 'penguji3');
    }
}