<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';

    protected $fillable = [
        'user_id',
        'nik',
        'nisn',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'alamat',
        'nomor_kk',
        'tanggal_terbit_kk',
        'latitude',
        'longitude',
        'no_hp',
    ];

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

    /**
     * Menghitung usia peserta berdasarkan jenjang pendaftaran dan tanggal batas usia (cut-off).
     */
    public function getUsiaSesuaiJenjang(): ?array
    {
        $pendaftaran = $this->pendaftaran;
        if (! $pendaftaran || ! $pendaftaran->periode) {
            return null;
        }

        $periode = $pendaftaran->periode;
        $jenjang = $pendaftaran->jenjang;

        $referenceDate = $jenjang == 'SD'
            ? $periode->tanggal_batas_usia_sd
            : $periode->tanggal_batas_usia_smp;

        if (! $referenceDate) {
            return null;
        }

        $birthDate = Carbon::parse($this->tanggal_lahir);
        $refDate = Carbon::parse($referenceDate);
        $diff = $birthDate->diff($refDate);

        $years = $diff->y;
        $months = $diff->m;

        $isValid = true;
        $message = '';

        if ($jenjang == 'SD') {
            if ($years < $periode->usia_min_sd) {
                $isValid = false;
                $message = "Usia di bawah minimal ({$periode->usia_min_sd} tahun)";
            } elseif ($years > $periode->usia_max_sd) {
                $isValid = false;
                $message = "Usia di atas maksimal ({$periode->usia_max_sd} tahun)";
            }
        } elseif ($jenjang == 'SMP') {
            if ($years > $periode->usia_max_smp) {
                $isValid = false;
                $message = "Usia di atas maksimal ({$periode->usia_max_smp} tahun)";
            }
        }

        return [
            'tahun' => $years,
            'bulan' => $months,
            'string' => "{$years} Tahun {$months} Bulan",
            'is_valid' => $isValid,
            'message' => $message,
        ];
    }
}
