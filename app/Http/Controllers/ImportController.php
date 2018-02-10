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
            $args = $reader->all();
        };
    	$args = Excel::load($url , $callback)->parsed;
        return response()->json($args);
    }

}
