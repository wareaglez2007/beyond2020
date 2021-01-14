<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/apps', 'HomeController@ApplicationView')->name('apps');
Route::get('/groups', 'HomeController@Groups')->name('groups');
Route::get('/employees', 'HomeController@Employees')->name('employees');
Route::get('/employees/edit/{id}', 'HomeController@EditEmployee')->name('employees.edit');
Route::post('/employee/edit/ajax', 'HomeController@AssignEmployee');
Route::post('/employee/activate', 'HomeController@ActivateEmployee');

/**
 * DATA SEEDER SECTION
 * ROSTOM SAHAKIAN
 * 01-12-2021
 */
Route::get('/seeder/adduser', 'SampleDataController@AddEmployees')->name('seeder.adduser');
Route::post('/seeder/adduser/employeenewseed', 'SampleDataController@AddEmployeesNewSeed');


Route::get('/seeder/adddevices', 'SampleDataController@AddDevices')->name('seeder.adddevices');
Route::get('/seeder/addroles', 'SampleDataController@AddRoles')->name('seeder.addroles');
Route::get('/seeder/addgroups', 'SampleDataController@AddGroups')->name('seeder.addgroups');
Route::get('/seeder/addapps', 'SampleDataController@AddApplications')->name('seeder.addapps');
