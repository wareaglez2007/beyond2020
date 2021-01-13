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
