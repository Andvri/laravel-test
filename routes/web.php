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

Route::get('/', 'StorageController@index');
Route::get('make', 'EmployeesController@create');
Route::get('empleados', 'EmployeesController@all');
Route::post('results', 'StorageController@save');

Route::get('error', function() {
  $strin = '                      Hola me llamo gladys';
  dd(($strin));

  return View('welcome');
});