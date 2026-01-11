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
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'ketua_sidang',
        'status',
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

    public function ketuaSidang()
    {
        return $this->belongsTo(Dosen::class, 'ketua_sidang');
    }
}
