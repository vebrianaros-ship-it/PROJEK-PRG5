<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranDemo extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_demo';

    protected $fillable = [
        'kelompok_id',
        'tanggal_usulan',
        'lokasi',
        'file_pendaftaran',
        'file_revisi',
        'status',
    ];

    protected $casts = [
        'tanggal_usulan' => 'date',
    ];

    /**
     * Relationships
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }
}
