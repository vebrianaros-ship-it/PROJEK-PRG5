<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'prodi',
        'tingkat',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelompokMahasiswa()
    {
        return $this->hasMany(KelompokMahasiswa::class);
    }

    public function kelompok()
    {
        return $this->belongsToMany(Kelompok::class, 'kelompok_mahasiswa');
    }
}
