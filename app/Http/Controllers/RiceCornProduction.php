<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\FarmActivity;
use App\Models\FixedLocation;
use App\Models\Program;
use Illuminate\Http\Request;

class RiceCornProduction extends Controller
{
    
    public function index(){
        $data['identifier'] = "Production | Farm Production";
        $data['data'] = "Production - FFIMS Systems";
        $data['farmActivity'] =  FarmActivity::showAllActivity();
        $data['listOfProgram'] = Program::where(['program_status' => 'Active', 'program.is_deleted' => '0'])->where('program_id', '!=', 37)
        ->orderBy('program.created_at', 'desc')->get();
        $citymun_id = FixedLocation::showMyLocation()->citymun_id;
        $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
        return view('administrator.production.production', $data);
    }


}
