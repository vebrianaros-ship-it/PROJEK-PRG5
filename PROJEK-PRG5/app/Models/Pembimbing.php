<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;

    protected $table = 'pembimbing';

    protected $fillable = [
        'kelompok_id',
        'dosen_id',
        'is_utama',
    ];

    protected $casts = [
        'is_utama' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
