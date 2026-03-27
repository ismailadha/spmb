<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalTahapan extends Model
{
    protected $table = 'jadwal_tahapan';

    protected $fillable = [
        'jadwal_id',
        'nama_tahapan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
    ];

    public $timestamps = false;

    public function jadwal()
    {
        return $this->belongsTo(JadwalDaftar::class, 'jadwal_id', 'id');
    }
}
