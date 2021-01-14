<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employees_devices extends Model
{
    protected $fillable = [
        'employees_id', 'devices_id'
    ];
}
