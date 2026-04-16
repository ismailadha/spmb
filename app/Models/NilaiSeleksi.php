<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSeleksi extends Model
{
    protected $table = 'nilai_seleksi';

    protected $fillable = [
        'pendaftaran_id',
        'rata_rapor',
        'nilai_tes_akademik',
        'nilai_prestasi',
        'skor_jarak',
        'skor_usia',
        'nilai_akhir',
        'nilai_1',
        'nilai_2',
    ];

    public $timestamps = false;

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
