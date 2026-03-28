<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'peserta_id',
        'sekolah_jalur_id',
        'nomor_pendaftaran',
        'tanggal_daftar',
        'status',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function sekolahJalur()
    {
        return $this->belongsTo(SekolahJalur::class);
    }

    public function nilaiSeleksi()
    {
        return $this->hasOne(NilaiSeleksi::class);
    }
}
