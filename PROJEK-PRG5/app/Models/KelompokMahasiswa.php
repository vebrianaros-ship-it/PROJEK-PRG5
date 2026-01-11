<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'kelompok_mahasiswa';
    public $timestamps = false;

    protected $fillable = [
        'kelompok_id',
        'mahasiswa_id',
    ];

    /**
     * Relationships
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
