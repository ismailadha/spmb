<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilSeleksi extends Model
{
    protected $table = 'hasil_seleksi';

    protected $fillable = [
        'pendaftaran_id',
        'status',
        'keterangan',
    ];

    public $timestamps = false;

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
