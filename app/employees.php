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

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\role');
    }

    public function groups()
    {
        return $this->belongsToMany('App\groups');
    }

    public function applications()
    {
        return $this->belongsToMany('App\applications', 'employees_applications');
    }
    public function devices()
    {
        return $this->belongsToMany('App\devices', 'employees_devices');
    }
}
