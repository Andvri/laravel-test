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

Route::get('test', function() {
  $string = "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '85351668999' for key 'employees_rfc_unique' (SQL: insert into `employees` (`names`, `paternal_surname`, `maternal_surname`, `birthdate`, `phone`, `gender`, `rfc`, `curp`, `ife_key`, `elector_key`, `imss`, `contract_date`, `company_id`, `nationality_mode_id`, `marital_statuses_id`, `colony_id`, `updated_at`, `created_at`) values (Hayley, Mueller, Rodriguez, 1969-12-31, 076 8661 5966, Femenino, 85351668999, 46627128, 800715369, 740996368, 1643050929299, 2018-01-01, 101, 2, 4, 510, 2018-02-11 04:43:27, 2018-02-11 04:43:27))";
  $arr =explode('\'',$string);
  $arr[3] = explode('_',$arr[3]);
  return $arr;
});