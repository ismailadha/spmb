<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeJalur extends Model
{
    protected $table = 'periode_jalur';

    protected $fillable = [
        'periode_id',
        'jalur_id',
        'pendaftaran_mulai',
        'pendaftaran_selesai',
        'verifikasi_mulai',
        'verifikasi_selesai',
        'daftar_ulang_mulai',
        'daftar_ulang_selesai',
    ];

    public function periode()
    {
        return $this->belongsTo(PeriodeDaftar::class, 'periode_id');
    }

    public function jalur()
    {
        return $this->belongsTo(JalurPendaftaran::class, 'jalur_id');
    }

    public $timestamps = false;
}
