<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orang_tua_wali';

    protected $fillable = [
        'peserta_id',
        'nama_wali',
        'alamat_wali',
        'pekerjaan_wali',
        'no_hp',
    ];

    public $timestamps = false;

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
