<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalurDaftar extends Model
{
    protected $table = 'jalur_pendaftaran';

    protected $fillable = [
        'nama_jalur',
        'deskripsi',
    ];

    public $timestamps = false;
}
