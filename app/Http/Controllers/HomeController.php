<?php

namespace App\Http\Controllers;

use App\applications;
use Illuminate\Http\Request;
use App\employees;
use App\role;
use App\devices;
use App\groups;
use App\employees_role;
use App\employees_group;
use App\employees_applications;
use App\employees_devices;

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
    public function index(employees $employee, role $role, devices $devices, groups $groups)
    {

        //Home should have the general information such as number employees, number of devices and status view
        //get total count of employess
        $a_employee_count = $employee->get()->where('active', 1)->count();
        $d_employee_count = $employee->get()->where('active', 0)->count();
        $a_devices_count = $devices->get()->where('active', 1)->count();
        $in_devices_count = $devices->get()->where('active', 0)->count();

        $employee_info = $employee->with('devices')->with('roles')->with('groups')->get();
        $device_info = $devices->all();
        $d = $devices->with('employees')->orderBy('active', 'DESC')->get();
        // foreach($d as $dd){
        // dd($employee_info);
        // }


        return view('home', [
            'a_e_count' => $a_employee_count,
            'd_e_count' => $d_employee_count,
            'a_d_count' => $a_devices_count,
            'in_d_count' => $in_devices_count,
            'employee_info' => $employee_info,
            'employee_device' => $d


        ]);
    }

    /**
     * View for Applications section
     */
    public function ApplicationView(applications $applications)
    {
        $apps = $applications->all();
        return view('applications', ['apps' => $apps]);
    }
    /**
     * View for Groups
     *
     */
    public function Groups(groups $groups)
    {
        $groups_info = $groups->all();
        return view('groups', ['groups' => $groups_info]);
    }
    /**
     * View for employees
     */
    public function Employees(employees $employees)
    {
        $employee_info = $employees->all();
        return view('employees', ['employee_info' => $employee_info]);
    }

    /**
     * EMPLOYEE EDIT PAGE SEND DATA
     */
    public function EditEmployee(employees $employees, role $role, devices $devices, groups $groups, applications $applications, Request $request, $id)
    {


        $employee_info = $employees->find($id);
        $device_info = $devices->all();
        $groups_info = $groups->orderBy('group', 'ASC')->get();
        $role_info = $role->orderBy('roles', 'ASC')->get();
        $applications_info = $applications->orderBy('application', 'ASC')->get();


        $employee_role_data = $employees->find($id);

        return view('editemployee', [
            'employee_info' => $employee_info,
            'devices' => $device_info,
            'groups' => $groups_info,
            'roles' => $role_info,
            'apps' => $applications_info,
            'assigned_roles' => $employee_role_data->roles,
            'assigned_group' => $employee_role_data->groups,
            'assigned_applications' => $employee_role_data->applications,
            'assigned_device' => $employee_role_data->devices

        ]);
    }
    public function AssignEmployee(Request $request, employees $employees, employees_role $employees_role, employees_group $employees_group, employees_applications $employees_applications, employees_devices $employees_devices, devices $devices)
    {
        $error = 1;
        if ($request->ajax()) {

            $employee_assignment_data = $employees->find($request->id);

            //ROLES
            if ($request->roles != NULL) {
                //Before inserting delete the old values
                $delete_old_data = $employees_role->where('employees_id', $request->id)->forceDelete();
                foreach ($request->roles as $role) {
                    $employees_role->create([
                        'employees_id' => $request->id,
                        'role_id' => $role
                    ]);
                }
            }

            //GROUPS
            $delete_old_group_data = $employees_group->where('employees_id', $request->id)->forceDelete();
            $employees_group->employees_id = $request->id;
            $employees_group->groups_id = $request->groups;
            $employees_group->save();

            //Applications
            $delete_old_app_data = $employees_applications->where('employees_id', $request->id)->forceDelete();
            // dd($request->apps);
            $ser_apps = array();
            parse_str($request->apps, $ser_apps);

            foreach ($ser_apps as $key => $apps) {
                foreach ($apps as $app) {
                    $employees_applications->create([
                        'employees_id' => $request->id,
                        'applications_id' => $app
                    ]);
                }
            }

            //Devices
            //IF THE DEVICE IS NONE REQUEST->DEVICE is 0 -> Then delete a value from employees_devices (if it exsits)
            if ($request->device == 0) {
                //BEFORE REMOVING LETS SEE IF THAT VALUE EVEN EXSITS
                $count_employees_devices_table_count = $employees_devices->where('employees_id', $request->id)->count();

                //IF THE RETURN VALUE IS ZERO THAT MEANS NO FURTHER ACTION IS NEEDED THE DATA WAS NEVER THERE
                if ($count_employees_devices_table_count != 0) {

                    $old_device = $employees_devices->where('employees_id', $request->id)->first();
                    //WE ALSO WANT TO DEACTIVATE THE OLD ASSIGNED DEVICE
                    $devices->where('id', $old_device->devices_id)->update(['active' => 0]);
                    //THEN DELETE THE RECORD FROM EMPLOYEES_DEVICES TABLE
                    $employees_devices->where('devices_id', $old_device->devices_id)->forceDelete();
                    $error = 0;
                } else {
                    $error = 0;
                }
            } else {
                $old_device = $employees_devices->where('employees_id', $request->id)->first();
                if ($old_device != NULL) {
                    if ($old_device->devices_id != $request->device) { // IF THERE IS A NEW DEVICE
                        //NOW FOR ALL REQUESTS THAT ARE NONE ZERO
                        //1st LETS CHECK IF THAT DEVICE IS ASSIGNED OR NOT
                        $d_count = $employees_devices->where('devices_id', $request->device)->count();

                        $errors = "Cannot assign this device because it has been already assigned";
                        if ($d_count > 0) {
                            return response()->json(['error' => $errors], 422);
                        } else {
                            $employees_count = $employees_devices->where('employees_id', $request->id)->count();
                            if ($employees_count == 0) {
                                //IF NOT LETS STORE THE INFOMATION IN TABLE EMPLOYEES_DEVICES AND ALSO ACTIVATE THE DEVICE IN DEVICES TABLE
                                $employees_devices->employees_id = $request->id;
                                $employees_devices->devices_id = $request->device;
                                $employees_devices->save();
                                //Update the last entry
                                $devices->where('id', $request->device)->update(['active' => 1]);
                                $error = 0;
                            } else {
                                $old_device = $employees_devices->where('employees_id', $request->id)->first();
                                //WE ALSO WANT TO DEACTIVATE THE OLD ASSIGNED DEVICE
                                $devices->where('id', $old_device->devices_id)->update(['active' => 0]);
                                //WE NEED TO JUST UPDATE THE DEVICE VALUE AND DEACTIVATE THE OLD DEVICE
                                $employees_devices->where('employees_id', $request->id)->update(['devices_id' => $request->device]);
                                $devices->where('id', $request->device)->update(['active' => 1]);
                                $error = 0;
                            }
                        }
                    } else {
                        $error = 0;
                    }
                } else { //there are no records found and the request is not zero
                    //NOW FOR ALL REQUESTS THAT ARE NONE ZERO
                    //1st LETS CHECK IF THAT DEVICE IS ASSIGNED OR NOT
                    $d_count = $employees_devices->where('devices_id', $request->device)->count();

                    $errors = "Cannot assign this device because it has been already assigned";
                    if ($d_count > 0) {
                        return response()->json(['error' => $errors], 422);
                    } else {
                        //IF NOT LETS STORE THE INFOMATION IN TABLE EMPLOYEES_DEVICES AND ALSO ACTIVATE THE DEVICE IN DEVICES TABLE
                        $employees_devices->employees_id = $request->id;
                        $employees_devices->devices_id = $request->device;
                        $employees_devices->save();
                        //Update the last entry
                        $devices->where('id', $request->device)->update(['active' => 1]);
                        $error = 0;
                    }
                }
            }
            if ($error == 0) {
                $success_message = "User has been updated";
            } else {
                $errors = "issues";
                return response()->json(['error' => $errors], 422);
            }

            return response()->json(['success' => $success_message]);
        }
    }

    /**
     * Activate employee
     */
    public function ActivateEmployee(employees $employees, Request $request)
    {
        //dd($request);
        if ($request->ajax()) {

            $emp = $employees->find($request->id);
            if ($emp->active == 0) {
                $employees->where('id', $request->id)->update(['active' => 1]);
            } else {
                $employees->where('id', $request->id)->update(['active' => 0]);
            }
            $employee_info = $employees->all();
            return view('employees', ['employee_info' => $employee_info])->render();
            // return view('employees')->render();
        }
    }
}
