<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employees_group extends Model
{
    protected $fillable = [
        'employees_id', 'groups_id'
    ];

}
