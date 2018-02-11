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
class StorageController extends Controller
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
    
    public function index()
    {
        return view('new');
    }
    public function save(Request $request)
    {   
        //dd($request);
       $file = $request->file('file');
       
       $nombre = $file->getClientOriginalName();
       $extension = $file->getClientOriginalExtension();
       //dd($extension);
       if($extension === 'xls' || $extension === 'xlsx'){
            $nombre = explode('.',$nombre);
            $r1 = \Storage::disk('local')->put('data.' . end($nombre),  \File::get($file));
            $url = public_path() . '/storage/data.' . end($nombre);
            $args = array();
            $employeesSuccess = [];
            $employeesFail = [];
            $employeesErrors = [];
            $employeesSave = [];

            Excel::load($url , function($reader) use (&$args) {
                $reader->ignoreEmpty();
                $reader->limitColumns(27);
               // dd($reader->get());
                //dd($reader->all());
                $args = $reader->get();
            });
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
                    //dd($emp);
                    if(
                        (($emp->clave_del_ife === null)  && ($emp->clave_de_elector !== null))
                        ||
                        (($emp->clave_del_ife !== null)  && ($emp->clave_de_elector === null))
                    ){
                        array_push($rowErrors,'No esta permitido que solo uno de los campos Clave del IFE y Clave del Elector reciban un valor');
                        throw new \Exception("", 1);
                    }

                    dd($emp);
                    $employe =Employees::firstOrCreate(
                        [
                            'names' => $emp->nombres,
                            'paternal_surname' => $emp->apellido_paterno,
                            'maternal_surname' => $emp->apellido_materno,
                            'birthdate' => $emp->fecha_de_nacimiento,
                            'phone' => $emp->telefono,
                            'gender' => $emp->sexo,
                            'rfc' => ltrim($emp->rfc),
                            'curp' => $emp->curp,
                            'ife_key' => $emp->clave_del_ife,
                            'elector_key' => $emp->clave_de_elector,
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
                        $letEmploye['elector_key'] = $emp->clave_de_elector;
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
                    //dd($e);
                    $string = $e->getMessage();
                    if(strpos($string, 'unique') !== false){
                        $unique = explode('\'',$string);
                        $unique = explode('_',$unique[3]);
                        if($unique[2] === 'unique'){
                            array_push($rowErrors, 'El valor ' . $unique[1] . ' se encuentra ya registrado y debe se unico para todos');
                        } 
                    }
                    //dd($e->getMessage());
                    if(empty($rowErrors)){
                        array_push($rowErrors, 'El archivo contiene un formato invalido');
                    }
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
        
            //dd($args);
            
            return View('results.list', 
                [ 
                    'employeesFail' => $employeesFail,
                    'employeesErrors' => $employeesErrors, 
                    'employeesSave' => $employeesSave,
                    'duplicateEmployees' => $duplicateEmployees,    
                ]);
        

       } 
        
       return redirect('error');
       
       
    }
}
