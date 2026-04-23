<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JalurDaftar extends Model
{
    protected $table = 'jalur_pendaftaran';

    protected $fillable = [
        'nama_jalur',
        'deskripsi',
    ];

    public $timestamps = false;

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'jalur_id');
    }
}
