<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    protected $fillable = [
        'nama_sekolah',
        'thumbnail',
        'npsn',
        'jenjang',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'id_desa',
        'alamat',
        'email',
        'kode_pos',
        'website',
        'telepon',
        'latitude',
        'longitude',
        'status_perbatasan',
        'status_unggulan',
        'status_pilihan_1',
        'daya_tampung_prestasi',
        'daya_tampung_domisili',
        'daya_tampung_afirmasi',
        'daya_tampung_mutasi',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function sekolahPilihan1()
    {
        return $this->hasMany(Pendaftaran::class, 'sekolah_pilihan_1');
    }

    public function sekolahPilihan2()
    {
        return $this->hasMany(Pendaftaran::class, 'sekolah_pilihan_2');
    }

    /**
     * Get the total daya tampung calculated from all paths.
     */
    protected function totalDayaTampung(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->daya_tampung_prestasi ?? 0) +
                         ($this->daya_tampung_domisili ?? 0) +
                         ($this->daya_tampung_afirmasi ?? 0) +
                         ($this->daya_tampung_mutasi ?? 0),
        );
    }

    // disable timestamps
    public $timestamps = false;
}
