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
        'jenjang',
        'nomor_pendaftaran',
        'tanggal_daftar',
        'sekolah_pilihan_1',
        'sekolah_pilihan_2',
        'sekolah_diterima_id',
        'jarak_sekolah_1',
        'jarak_sekolah_2',
        'status',
        'catatan_perbaikan',
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

    public function sekolahPilihan1()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_pilihan_1');
    }

    public function sekolahPilihan2()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_pilihan_2');
    }

    public function nilaiSeleksi()
    {
        return $this->hasOne(NilaiSeleksi::class);
    }

    public function sekolahDiterima()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_diterima_id');
    }

    public function berkas()
    {
        return $this->hasMany(BerkasPendaftaran::class);
    }
}
