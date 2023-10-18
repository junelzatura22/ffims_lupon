<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiceCornProduction extends Controller
{
    
    public function index(){
        $data['identifier'] = "Production | Farm Production";
        $data['data'] = "Production - FFIMS Systems";
        return view('administrator.production.production', $data);
    }
}
