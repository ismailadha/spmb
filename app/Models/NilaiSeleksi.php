<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSeleksi extends Model
{
    protected $table = 'nilai_seleksi';

    protected $fillable = [
        'pendaftaran_id',
        'jenis_nilai',
        'nilai',
        'bobot',
    ];

    public $timestamps = false;

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
