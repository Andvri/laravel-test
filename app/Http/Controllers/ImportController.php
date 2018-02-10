<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import()
    {   
        $url = public_path() . '/storage/FAKE.xls';
        $args = array();
        $callback = function($reader) use ($args) {
            //header('Content-type: application/json');
            $args = $reader->all();
            //dd($args);
            
            //echo json_encode($reader->get());
        };
    	$args = Excel::load($url , $callback)->parsed;
        //dd($args);
        return response()->json($args);
    }

}
