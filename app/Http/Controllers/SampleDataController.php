<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employees;
use App\devices;
use App\groups;
use App\applications;

class SampleDataController extends Controller
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


    //Add new Divces
    public function AddDevices(devices $devices, Request $request)
    {


        return view('seeders.addnewdevice');
    }

    public function AddDevicesNewSeed(devices $devices, Request $request)
    {
        $validatedData = $request->validate([
            'make' => ['required', 'max:50'],
            'model' => ['required', 'max:50'],
            'serial_number' => ['required', 'unique:devices', 'max:500'],
            'Device_name' => ['required', 'unique:devices'],
        ]);
        $devices->make = $request->make;
        $devices->model = $request->model;
        $devices->year = $request->year;
        $devices->OS = $request->OS;
        $devices->serial_number = $request->serial_number;
        $devices->Device_name = $request->Device_name;
        $devices->save();
        $success_message = "Device " . request('Device_name') . " has been added to inventory.";

        return response()->json(['success' => $success_message]);
    }
    //Add new Employees
    public function AddEmployees(employees $employees)
    {
        $emp_count = $employees->count();
        $employees_data = $employees->all();
        return view('seeders.addemployee', ['emp_count' => $emp_count, 'employee_data' => $employees_data]);
    }
    //AJAX call to store the new employee seed
    public function AddEmployeesNewSeed(employees $employees, Request $request)
    {
        //GET AJAX REQUEST AND ADD

        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'l_name' => ['required', 'max:50'],
            'office' => ['required', 'max:50'],
            'email' => ['required', 'unique:employees'],
        ]);


        $seid = $this->SEID_generator(5);

        $count = $employees->get()->count();
        $employees->seid = $seid;
        $employees->name = $request->name;
        $employees->m_name = $request->m_name;
        $employees->l_name = $request->l_name;
        $employees->email = $request->email;
        $employees->work_number = $request->work_number;
        $employees->office = $request->office;
        $employees->address1 = $request->address1;
        $employees->address2 = $request->address2;
        $employees->city = $request->city;
        $employees->state = $request->state;
        $employees->zip = $request->zip;
        $employees->start_date = date('d/m/Y');
        $employees->save();
        $success_message = "Employee " . request('name') . " has been added.";


        //if ($request->ajax()) {

        //  return view('seeders.addemployee', ['success' => $success_message])->render();
        //}


        return response()->json(['success' => $success_message]);
    }

    //ADD ROLES
    public function AddRoles()
    {
        return view('seeders.addroles');
    }

    //ADD GROUPS
    public function AddGroups(groups $groups, Request $request)
    {
        return view('seeders.addgroups');
    }

    //ADD APPLICATIONS
    public function AddApplications(applications $applications, Request $request)
    {
        return view('seeders.addapps');
    }


    public function SEID_generator($length_of_string)
    {
        // md5 the timestamps and returns substring
        // of specified length

        $seid = substr(md5(time()), 0, $length_of_string);

        $check_uniqeness = employees::where('seid', $seid)->get()->count();
        if ($check_uniqeness > 0) {
            $this->SEID_generator(5);
        } else {
            return $seid;
        }
    }
}
