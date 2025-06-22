<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $fillable = [
        'user_id',
        'no_rm',
        'no_ktp'
    ];

    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
    public function users() : BelongsTo 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function daftarPolis() : HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }
}
