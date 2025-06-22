<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Dokter extends Model
{
    protected $fillable = [
        'id_poli'
    ];

    public $timestamps = false;

    protected $primaryKey = 'user_id';

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function polis() : BelongsTo  
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function jadwalPeriksas() : HasMany
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }
}
