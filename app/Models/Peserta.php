<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'nisn',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'latitude',
        'longitude',
        'no_hp',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    // relasi ke orang tua
    public function orang_tua()
    {
        return $this->hasOne(OrangTua::class);
    }
}
