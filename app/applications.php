<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class applications extends Model
{
    protected $fillable = [
        'OS', 'application'
    ];
}
