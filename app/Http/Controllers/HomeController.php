<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employees;
use App\employee_roles;
use App\devices;
use App\groups;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(employees $employee, employee_roles $employee_roles, devices $devices, groups $groups)
    {

        //Home should have the general information such as number employees, number of devices and status view



        return view('home');
    }
}
