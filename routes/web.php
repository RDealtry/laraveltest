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
    return view('mytests.index');
});

// Advance Routes
Route::resource('mytests', 'MytestController');
Route::get('mytests_data/get_data', 'MytestGetController@index');
