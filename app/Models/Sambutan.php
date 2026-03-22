<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sambutan extends Model
{
    protected $table = 'sambutan';

    protected $fillable = [
        'id',
        'nama_pejabat',
        'jabatan',
        'foto',
        'isi_sambutan',
        'is_active',
        'sort_order',
    ];

    public $timestamps = false;

    public $incrementing = false;
}
