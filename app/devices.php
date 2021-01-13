<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class devices extends Model
{
    protected $fillable = [
        'make', 'model', 'year', 'OS', 'serial_number', 'Device_name', 'active'
    ];
}
