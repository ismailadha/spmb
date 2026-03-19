<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'jenjang',
        'jalur',
        'nik',
        'nisn',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'nomor_kk',
        'tanggal_kk',
        'nama_orang_tua',
        'alamat',
        'pasfoto',
        'akta_lahir',
        'kk',
        'ktp_orang_tua',
        'kartu_pkh',
        'surat_dokter',
        'surat_pindah',
        'sekolah_pilihan_1',
        'sekolah_pilihan_2',
    ];
}
