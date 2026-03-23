<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SekolahJalur extends Model
{
    protected $table = 'sekolah_jalur';

    protected $fillable = [
        'sekolah_id',
        'jalur_id',
        'periode_id',
        'kuota',
        'status',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function jalur()
    {
        return $this->belongsTo(JalurDaftar::class);
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeDaftar::class);
    }

    public $timestamps = false;
}
