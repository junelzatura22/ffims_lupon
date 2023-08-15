<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmerFisherFolkController extends Controller
{
    //

    public function index(){

        $data['identifier'] = "Farmer and Fisherfolk List";
        return view('administrator.f2.list',$data);
        
    }
    public function dashboard(){

        $data['identifier'] = "Welcome to JUNEL'S dashboard";
        return view('administrator.f2.dashboard',$data);
        
    }
    public function create(){

        $data['identifier'] = "Create Farmer and Fisherfolk Form";
        return view('administrator.f2.create',$data);
        
    }
}
