<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employees extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
       'seid',
       'name',
       'm_name',
       'l_name',
       'email',
       'work_number',
       'office',
       'address1',
       'address2',
       'city',
       'state',
       'zip',
       'start_date',
       'active',
       'telework'

    ];
}
