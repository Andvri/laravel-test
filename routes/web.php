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

Route::post('storage/create', 'StorageController@save');
Route::get('/', 'StorageController@index');
Route::get('make', 'EmployeesController@create');
Route::get('empleados', 'EmployeesController@all');
Route::get('results', 'ImportController@import');