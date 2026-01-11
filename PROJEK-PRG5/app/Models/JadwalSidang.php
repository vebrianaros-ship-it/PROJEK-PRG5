<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSidang extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sidang';

    protected $fillable = [
        'kelompok_id',
        'tanggal',
        'jam',
        'lokasi',
        'ketua_sidang',
        'status',
        'is_locked',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam' => 'datetime:H:i',
        'is_locked' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    public function ketuaSidang()
    {
        return $this->belongsTo(Dosen::class, 'ketua_sidang');
    }
}
