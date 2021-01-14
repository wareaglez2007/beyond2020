<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employees_applications extends Model
{
    //
    protected $fillable = [
        'employees_id', 'applications_id'
    ];

    protected $table = 'employees_applications';
}
