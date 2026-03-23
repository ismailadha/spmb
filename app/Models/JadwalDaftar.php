<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDaftar extends Model
{
    protected $table = 'jadwal_pendaftaran';

    protected $fillable = [
        'sekolah_jalur_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_pengumuman',
        'status',
    ];

    public $timestamps = false;
}
