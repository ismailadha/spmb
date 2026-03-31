<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'peserta_id',
        'periode_id',
        'jalur_id',
        'sekolah_id',
        'nomor_pendaftaran',
        'tanggal_daftar',
        'status',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeDaftar::class);
    }

    public function jalur()
    {
        return $this->belongsTo(JalurDaftar::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function nilaiSeleksi()
    {
        return $this->hasOne(NilaiSeleksi::class);
    }
}
