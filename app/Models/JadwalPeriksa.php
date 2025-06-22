<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class JadwalPeriksa extends Model
{
    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'is_active'
    ];

    public $timestamps = false;

    public function dokter() : BelongsTo 
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function daftarPolis() : HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
}
