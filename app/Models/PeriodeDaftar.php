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
        return $this->belongsToMany(JalurDaftar::class, 'periode_jalur', 'periode_id', 'jalur_id')
            ->withPivot([
                'pendaftaran_mulai',
                'pendaftaran_selesai',
                'verifikasi_mulai',
                'verifikasi_selesai',
                'daftar_ulang_mulai',
                'daftar_ulang_selesai',
            ]);
    }

    /**
     * Get the formatted schedule items for the frontend.
     */
    public function getFormattedSchedule(): array
    {
        $items = [];
        $jalurAktif = $this->jalur()->get();

        // 1. Pendaftaran Online
        if ($this->peserta_daftar_mulai && $this->peserta_daftar_selesai) {
            $subItems = [];
            foreach ($jalurAktif as $j) {
                if ($j->pivot->pendaftaran_mulai && $j->pivot->pendaftaran_selesai) {
                    $subItems[] = [
                        'nama' => $j->nama_jalur,
                        'mulai' => Carbon::parse($j->pivot->pendaftaran_mulai)->translatedFormat('d F Y'),
                        'selesai' => Carbon::parse($j->pivot->pendaftaran_selesai)->translatedFormat('d F Y'),
                    ];
                }
            }

            $items[] = [
                'icon' => 'la-edit',
                'warna' => '#3498db',
                'kegiatan' => 'Pendaftaran Online',
                'mulai' => Carbon::parse($this->peserta_daftar_mulai)->translatedFormat('d F Y'),
                'selesai' => Carbon::parse($this->peserta_daftar_selesai)->translatedFormat('d F Y'),
                'sub_items' => $subItems,
            ];
        }

        // 2. Verifikasi Berkas
        if ($this->verifikasi_mulai && $this->verifikasi_selesai) {
            $subItems = [];
            foreach ($jalurAktif as $j) {
                if ($j->pivot->verifikasi_mulai && $j->pivot->verifikasi_selesai) {
                    $subItems[] = [
                        'nama' => $j->nama_jalur,
                        'mulai' => Carbon::parse($j->pivot->verifikasi_mulai)->translatedFormat('d F Y'),
                        'selesai' => Carbon::parse($j->pivot->verifikasi_selesai)->translatedFormat('d F Y'),
                    ];
                }
            }

            $items[] = [
                'icon' => 'la-file-text',
                'warna' => '#27ae60',
                'kegiatan' => 'Verifikasi Berkas',
                'mulai' => Carbon::parse($this->verifikasi_mulai)->translatedFormat('d F Y'),
                'selesai' => Carbon::parse($this->verifikasi_selesai)->translatedFormat('d F Y'),
                'sub_items' => $subItems,
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
                'sub_items' => [],
            ];
        }

        // 4. Daftar Ulang
        if ($this->daftar_ulang_mulai && $this->daftar_ulang_selesai) {
            $subItems = [];
            foreach ($jalurAktif as $j) {
                if ($j->pivot->daftar_ulang_mulai && $j->pivot->daftar_ulang_selesai) {
                    $subItems[] = [
                        'nama' => $j->nama_jalur,
                        'mulai' => Carbon::parse($j->pivot->daftar_ulang_mulai)->translatedFormat('d F Y'),
                        'selesai' => Carbon::parse($j->pivot->daftar_ulang_selesai)->translatedFormat('d F Y'),
                    ];
                }
            }

            $items[] = [
                'icon' => 'la-check-square',
                'warna' => '#f39c12',
                'kegiatan' => 'Daftar Ulang',
                'mulai' => Carbon::parse($this->daftar_ulang_mulai)->translatedFormat('d F Y'),
                'selesai' => Carbon::parse($this->daftar_ulang_selesai)->translatedFormat('d F Y'),
                'sub_items' => $subItems,
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
                'sub_items' => [],
            ];
        }

        return $items;
    }
}
