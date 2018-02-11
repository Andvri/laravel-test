<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;



use App\Colonies;
use App\Companies;
use App\Employees;
use App\MaritalStatuses;
use App\Municipalities;
use App\NationalityModes;
use App\States;

class ImportController extends Controller
{
    private $optionalValues = 
        [
            'curp',
            'afiliacion_a_imss'
        ];
    private function getErrors($empRow){
        $errs = [];
        foreach ($empRow as $key => $value) {
            if(!in_array($key,$this->optionalValues) &&  $value === null){
                $val = explode('_', $key);
                $val = implode(' ', $val);
                array_push($errs,'El campo: ' . strtoupper($val) . ' es obligatorio' );
            }
        }

        return $errs;
    }
    public function import()
    {   
        $url = public_path() . '/storage/data.xls';
        $args = array();
        $employeesSuccess = [];
        $employeesFail = [];
        $employeesErrors = [];
        $employeesSave = [];

        $callback = function($reader) use ($args) {
            $args = $reader->all();
            //dd($reader->all());
        };
        $args = Excel::load($url , $callback)->parsed;
        $index=0;
        $duplicateEmployees = [];
        foreach ($args as $emp) {
            $rowErrors = [];
            //dd($emp);
            try{
                $company = Companies::firstOrCreate(['name' => $emp->empresa]);
                $state = States::firstOrCreate(['name' => $emp->entidad_de_nacimiento]);
                $municipality = Municipalities::firstOrCreate(['name' => $emp->municipio_de_nacimiento, 'state_id' => $state->id]);
                $colony = Colonies::firstOrCreate(['name' => $emp->colonia_de_nacimiento, 'municipality_id' => $municipality->id]);
                $nationality_mode = NationalityModes::firstOrCreate(['mode' => $emp->modo_de_nacionalidad]);
                $marital_status = MaritalStatuses::firstOrCreate(['name' => $emp->estado_civil]);
            }catch(\Exception $e){}
            $employe ='';

            try{
                $rowErrors = $this->getErrors($emp);
                if(
                    (($emp->clave_del_ife === null)  && ($emp->clave_del_elector !== null))
                    ||
                    (($emp->clave_del_ife !== null)  && ($emp->clave_del_elector === null))
                ){
                    array_push($rowErrors,'No esta permitido que solo uno de los campos Clave del IFE y Clave del Elector reciban un valor');
                    throw new \Exception("", 1);
                }
                $employe =Employees::firstOrCreate(
                    [
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
                        'colony_id' => $colony->id
                    ]
                );
                    $letEmploye = [];
                    $letEmploye['names'] = $emp->nombres;
                    $letEmploye['paternal_surname'] = $emp->apellido_paterno;
                    $letEmploye['maternal_surname'] = $emp->apellido_materno;
                    $letEmploye['birthdate'] = $emp->fecha_de_nacimiento;
                    $letEmploye['phone'] = $emp->telefono;
                    $letEmploye['gender'] = $emp->sexo;
                    $letEmploye['rfc'] = $emp->rfc;
                    $letEmploye['curp'] = $emp->curp;
                    $letEmploye['ife_key'] = $emp->clave_del_ife;
                    $letEmploye['elector_key'] = $emp->clave_del_elector;
                    $letEmploye['imss'] = $emp->afiliacion_a_imss;
                    $letEmploye['contract_date'] = $emp->fecha_de_contrato;
                    $letEmploye['company'] = $emp->empresa;
                    $letEmploye['nationality_mode'] = $emp->modo_de_nacionalidad;
                    $letEmploye['marital_statuses'] = $emp->estado_civil;
                    $letEmploye['colony'] =  $emp->colonia_de_nacimiento;
                    $letEmploye['municipality'] =  $emp->municipio_de_nacimiento;
                    $letEmploye['state'] =  $emp->entidad_de_nacimiento;
                    $letEmploye['id'] =   $employe->id;
                    
                if(!($employe->wasRecentlyCreated)){
                    array_push($duplicateEmployees,$letEmploye);    
                }else{
                    array_push($employeesSave,$letEmploye);
                }   
                //if($firstEmploye === null){
                  //  $firstEmploye = $employe->id;
                //}
            }catch(\Exception $e){
                $string = $e->getMessage();
                $unique = explode('\'',$string);
                $unique = explode('_',$unique[3]);
                if($unique[2] === 'unique'){
                    array_push($rowErrors, 'El valor ' . $unique[1] . ' se encuentra ya registrado y debe se unico para todos');
                }
                //dd($e->getMessage());
                $emp['index'] =  $index;
                $emp['errs'] = $rowErrors;
                //dd($rowErrors);
                //dd($emp);
                array_push($employeesErrors,$rowErrors);
                array_push($employeesFail,$emp);
            }
            $index++;
        }
        //$employeesSave = Employees::with(['company', 'colony', 'colony.municipality', 'colony.municipality.state', 'marital_statuses', 'nationality_mode'])
          //                          ->where('id', '>=', $firstEmploye )
            //                        ->get();
       
        
        return View('results.list', 
            [ 
                'employeesFail' => $employeesFail,
                'employeesErrors' => $employeesErrors, 
                'employeesSave' => $employeesSave,
                'duplicateEmployees' => $duplicateEmployees,    
            ]);
       
    }

}
