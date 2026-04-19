<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = 'persyaratan';

    protected $fillable = [
        'kunci',
        'nilai',
    ];

    public $timestamps = false;
}
