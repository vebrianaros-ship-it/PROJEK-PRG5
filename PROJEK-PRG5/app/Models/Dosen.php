<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nip',
        'nama',
        'pendidikan',
        'is_aa',
        'status',
        'user_id',
    ];

    protected $casts = [
        'is_aa' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class);
    }

    public function availabilities()
    {
        return $this->hasMany(AvailabilityDosen::class);
    }

    public function jadwalDemoAsKetua()
    {
        return $this->hasMany(JadwalDemo::class, 'ketua_demo');
    }

    public function jadwalDemoAsPenguji1()
    {
        return $this->hasMany(JadwalDemo::class, 'penguji1');
    }

    public function jadwalDemoAsPenguji2()
    {
        return $this->hasMany(JadwalDemo::class, 'penguji2');
    }

    public function jadwalDemoAsPenguji3()
    {
        return $this->hasMany(JadwalDemo::class, 'penguji3');
    }

    public function jadwalSidangAsKetua()
    {
        return $this->hasMany(JadwalSidang::class, 'ketua_sidang');
    }
}
