<?php

namespace App\Models;

use Carbon\Carbon;
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
        'tanggal_batas_usia_sd',
        'usia_min_sd',
        'usia_max_sd',
        'tanggal_batas_usia_smp',
        'usia_max_smp',
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

    /**
     * Get the formatted schedule items for the frontend.
     */
    public function getFormattedSchedule(): array
    {
        $items = [];

        // 1. Pendaftaran Online
        if ($this->peserta_daftar_mulai && $this->peserta_daftar_selesai) {
            $items[] = [
                'icon' => 'la-edit',
                'warna' => '#3498db',
                'kegiatan' => 'Pendaftaran Online',
                'mulai' => Carbon::parse($this->peserta_daftar_mulai)->translatedFormat('d F Y'),
                'selesai' => Carbon::parse($this->peserta_daftar_selesai)->translatedFormat('d F Y'),
            ];
        }

        // 2. Verifikasi Berkas
        if ($this->verifikasi_mulai && $this->verifikasi_selesai) {
            $items[] = [
                'icon' => 'la-file-text',
                'warna' => '#27ae60',
                'kegiatan' => 'Verifikasi Berkas',
                'mulai' => Carbon::parse($this->verifikasi_mulai)->translatedFormat('d F Y'),
                'selesai' => Carbon::parse($this->verifikasi_selesai)->translatedFormat('d F Y'),
            ];
        }

        // 3. Pengumuman Seleksi
        if ($this->tanggal_pengumuman_seleksi) {
            $items[] = [
                'icon' => 'la-list-ol',
                'warna' => '#e74c3c',
                'kegiatan' => 'Pengumuman Seleksi',
                'mulai' => Carbon::parse($this->tanggal_pengumuman_seleksi)->translatedFormat('d F Y'),
                'selesai' => Carbon::parse($this->tanggal_pengumuman_seleksi)->translatedFormat('d F Y'),
            ];
        }

        // 4. Daftar Ulang
        if ($this->daftar_ulang_mulai && $this->daftar_ulang_selesai) {
            $items[] = [
                'icon' => 'la-check-square',
                'warna' => '#f39c12',
                'kegiatan' => 'Daftar Ulang',
                'mulai' => Carbon::parse($this->daftar_ulang_mulai)->translatedFormat('d F Y'),
                'selesai' => Carbon::parse($this->daftar_ulang_selesai)->translatedFormat('d F Y'),
            ];
        }

        // 5. Hari Pertama Masuk Sekolah
        if ($this->tanggal_masuk_sekolah) {
            $items[] = [
                'icon' => 'la-graduation-cap',
                'warna' => '#9b59b6',
                'kegiatan' => 'Hari Pertama Masuk Sekolah',
                'mulai' => Carbon::parse($this->tanggal_masuk_sekolah)->translatedFormat('d F Y'),
                'selesai' => Carbon::parse($this->tanggal_masuk_sekolah)->translatedFormat('d F Y'),
            ];
        }

        return $items;
    }
}
