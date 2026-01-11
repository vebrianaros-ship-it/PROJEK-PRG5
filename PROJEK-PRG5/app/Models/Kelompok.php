<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompok';

    protected $fillable = [
        'nama_kelompok',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function kelompokMahasiswa()
    {
        return $this->hasMany(KelompokMahasiswa::class);
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'kelompok_mahasiswa');
    }

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class);
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'pembimbing');
    }

    public function pendaftaranDemo()
    {
        return $this->hasMany(PendaftaranDemo::class);
    }

    public function jadwalDemo()
    {
        return $this->hasMany(JadwalDemo::class);
    }

    public function jadwalSidang()
    {
        return $this->hasMany(JadwalSidang::class);
    }

    public function jadwalDemoPL()
    {
        return $this->hasMany(JadwalDemoPL::class);
    }
}
