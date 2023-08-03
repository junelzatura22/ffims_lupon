<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
class LocationController extends Controller
{
    //

    public function index(){
          
        $data['identifier'] = "Location | User Location";
        return view('administrator.location.dashboard', $data);
    }
}
