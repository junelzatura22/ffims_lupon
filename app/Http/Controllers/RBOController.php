<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RBOController extends Controller
{
    //
    public function index(){
        $data['identifier'] = "RBO | RBO List";
        return view('administrator.rbo.list',$data);
    }
    public function cluster(){
        $data['identifier'] = "RBO | RBO List of Cluster";
        return view('administrator.rbo.cluster',$data);
    }
    public function association(){
        $data['identifier'] = "RBO | RBO List of Association";
        return view('administrator.rbo.association',$data);
    }
}
