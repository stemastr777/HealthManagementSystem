<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Poli extends Model
{
    protected $fillable = [
        'nama_poli',
        'keterangan',
        'is_active'
    ];

    public $timestamps = false;

    public function dokters() : HasMany 
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }
}
