<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    
    public function index()
    {
        return view('new');
    }
    public function save(Request $request)
    {   
        //dd($request);
       $file = $request->file('file');
       
       $nombre = $file->getClientOriginalName();
       $nombre = explode('.',$nombre);
        
       \Storage::disk('local')->put('data.' . end($nombre),  \File::get($file));
       return redirect('results');
    }
}
