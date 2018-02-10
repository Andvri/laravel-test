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
    
    public function create() {
        $company = Companies::firstOrCreate(['name' => 'FPV']);
        $state = States::firstOrCreate(['name' => 'MEXICO']);
        $municipality = Municipalities::firstOrCreate(['name' => 'TEXOCO', 'state_id' => $state->id]);
        $colony = Colonies::firstOrCreate(['name' => 'AHUEHETES', 'municipality_id' => $municipality->id]);
        $nationality_mode = NationalityModes::firstOrCreate(['mode' => 'NACIMIENTO']);
        $marital_status = MaritalStatus::firstOrCreate(['name' => 'VIUDO']);
        $employe ='';
        $employeesSuccess = [];
        $employeesFail = [];
        try{
            $employe = Employees::firstOrCreate([
                'names' => 'JAVIER ANDRES',
                'paternal_surname' => 'MARTINEZ',
                'maternal_surname' => 'BOADA',
                'birthdate' => '1996-05-16',
                'phone' => '4140818610',
                'gender' => 'MASCULINO',
                'rfc' => '11',
                'curp' => '111',
                'ife_key' => '151',
                'elector_key' => '456',
                'imss' => '554545',
                'contract_date' => '2018-02-10',
                'company_id' => 1,
                'nationality_mode_id' => 1,
                'marital_statuses_id' => 1,
                'colony_id' => 1,
            ]);
        }catch(\Exception $e){
            dd($e);
        }
        

        return $employe;
    }

    public function all() {
        return Employees::all();
    }

}
