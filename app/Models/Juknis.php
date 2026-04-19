<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juknis extends Model
{
    protected $table = 'juknis';

    protected $fillable = [
        'kunci',
        'nilai',
    ];

    public $timestamps = false;
}
