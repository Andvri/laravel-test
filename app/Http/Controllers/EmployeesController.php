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
        return Employees::all();
    }

}
