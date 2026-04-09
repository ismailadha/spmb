<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeDaftar extends Model
{
    protected $table = 'periode_pendaftaran';

    protected $fillable = [
        'tahun_ajaran',
        'peserta_daftar_mulai',
        'peserta_daftar_selesai',
        'verifikasi_mulai',
        'verifikasi_selesai',
        'tanggal_pengumuman_seleksi',
        'daftar_ulang_mulai',
        'daftar_ulang_selesai',
        'tanggal_masuk_sekolah',
        'batas_usia_sd',
        'batas_usia_smp',
        'status_aktif',
    ];

    public $timestamps = false;

    public function isPesertaDaftarOpen()
    {
        $now = now();

        return $now->between($this->peserta_daftar_mulai, $this->peserta_daftar_selesai);
    }

    public function jalur()
    {
        return $this->belongsToMany(JalurDaftar::class, 'periode_jalur', 'periode_id', 'jalur_id');
    }
}
