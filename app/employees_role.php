<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employees_role extends Model
{
    //
    protected $fillable = [
        'employees_id', 'role_id'
    ];

    protected $table = 'employees_role';
}
