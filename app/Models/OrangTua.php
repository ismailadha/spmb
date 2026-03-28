<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orang_tua';

    protected $fillable = [
        'peserta_id',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'penghasilan_bulanan',
        'alamat_ortu',
        'no_hp',
    ];

    public $timestamps = false;

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
