<?php

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

    Route::get('peran', ['as' => 'peran' ,'uses' => 'Admin\RolePermissionController@index']);
    Route::get('perans', ['uses' => 'Admin\RolePermissionController@store']);
    //Route::get('updatePermission', ['uses' => 'Admin\RolePermissionController@updatePermission']);





Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/donor-mapping', 'DonorActivityController@index')->name('donor-activity');
Route::get('/donor-report', 'DonorActivityController@report')->name('donor-report');
Route::post('/add-donor', 'DonorOrganizationsController@store')->name('add-donor');
Route::get('/add-donor', 'DonorOrganizationsController@index')->name('add-donor');
// Route::get('/anggaran', 'DonorActivityController@anggaran')->name('anggaran');
