<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Colonies;
use App\Companies;
use App\Employees;
use App\MaritalStatuses;
use App\Municipalities;
use App\NationalityModes;
use App\States;


class EmployeesController extends Controller
{
    
  

    public function all() {
        $data = Employees::with(['company', 'colony', 'colony.municipality', 'colony.municipality.state', 'marital_statuses', 'nationality_mode'])->where('id', '>=', 0 )->get();
        return View('results.todo', [ "data" => $data]);
    }

}
