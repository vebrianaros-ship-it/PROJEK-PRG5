<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityDosen extends Model
{
    use HasFactory;

    protected $table = 'availability_dosen';

    protected $fillable = [
        'dosen_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    /**
     * Relationships
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
