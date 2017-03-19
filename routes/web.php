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
    Route::group(array('prefix' => 'api'), function() {
        //Route::resource('students','APIController');
        Route::get('students/all','APIController@index');
        Route::post('students/create','APIController@store');
        ROute::get('students/{id}','APIController@show');
    });