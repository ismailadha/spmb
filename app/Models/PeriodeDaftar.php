<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeDaftar extends Model
{
    protected $table = 'periode_pendaftaran';

    protected $fillable = [
        'tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_aktif',
    ];

    public $timestamps = false;
}
