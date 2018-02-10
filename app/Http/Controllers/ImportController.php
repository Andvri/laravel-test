<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;



use App\Colonies;
use App\Companies;
use App\Employees;
use App\MaritalStatus;
use App\Municipalities;
use App\NationalityModes;
use App\States;

class ImportController extends Controller
{
    public function import()
    {   
        $url = public_path() . '/storage/data.xls';
        $args = array();
        $employeesSuccess = [];
        $employeesFail = [];
        $firstEmploye = null;
        $callback = function($reader) use ($args) {
            $args = $reader->all();
            //dd($reader->all());
        };
        $args = Excel::load($url , $callback)->parsed;
        $index=0;
        foreach ($args as $emp) {
            //dd($emp);
            $company = Companies::firstOrCreate(['name' => $emp->empresa]);
            $state = States::firstOrCreate(['name' => $emp->entidad_de_nacimiento]);
            $municipality = Municipalities::firstOrCreate(['name' => $emp->municipio_de_nacimiento, 'state_id' => $state->id]);
            $colony = Colonies::firstOrCreate(['name' => $emp->colonia_de_nacimiento, 'municipality_id' => $municipality->id]);
            $nationality_mode = NationalityModes::firstOrCreate(['mode' => $emp->modo_de_nacionalidad]);
            $marital_status = MaritalStatus::firstOrCreate(['name' => $emp->estado_civil]);
            $employe ='';
            try{
                $employe = Employees::firstOrCreate([
                    'names' => $emp->nombres,
                    'paternal_surname' => $emp->apellido_paterno,
                    'maternal_surname' => $emp->apellido_materno,
                    'birthdate' => $emp->fecha_de_nacimiento,
                    'phone' => $emp->telefono,
                    'gender' => $emp->sexo,
                    'rfc' => $emp->rfc,
                    'curp' => $emp->curp,
                    'ife_key' => $emp->clave_del_ife,
                    'elector_key' => $emp->clave_del_elector,
                    'imss' => $emp->afiliacion_a_imss,
                    'contract_date' => $emp->fecha_de_contrato,
                    'company_id' => $company->id,
                    'nationality_mode_id' => $nationality_mode->id,
                    'marital_statuses_id' => $marital_status->id,
                    'colony_id' => $colony->id,
                ]);
                if($firstEmploye === null)
                    $firstEmploye = $employe->id;
            }catch(\Exception $e){
                //dd($e->getMessage());
                $emp['index'] =  $index;
                //dd($emp);
                array_push($employeesFail,$emp);
            }
            $index++;
        }
        $employeesSave = Employees::where('id', '>=', $firstEmploye )->get();
        //dd($employeesSave);
        foreach ($employeesSave as $value) {
            ($value->maternal_surname);
        }
        //dd($employeesFail);
        return View('results.app', [ 'employeesFail' => $employeesFail, 'employeesSave' => $employeesSave ]);
       
    }

}
