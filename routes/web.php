<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
Route::get('driverr', function () {
    return view('Driver/index');
});
Route::get('jenisskendaraan', function () {
    return view('jeniskendaraan/index');
});


Route::resource('driverr', DriverController::class);
Route::get('driverr', 'DriverController@index');
Route::delete('driverr/{id}', 'DriverController@destroy');



Route::resource('monitoring_kendaraan', monitoring_kendaraanController::class);
Route::get('monitoring_kendaraan', 'monitoring_kendaraanController@index');
Route::delete('monitoring_kendaraan/{id}', 'monitoring_kendaraanController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('editor')->middleware('is_admin');
Route::get('editor/home', 'HomeController@editor')->name('admin.home')->middleware('is_admin');
Route::get('export-laravel','ExportLaravelController@export');
Route::get('/monitor', 'MonitorController@index');
Route::get('/monitor/export_excel', 'MonitorController@export_excel');


