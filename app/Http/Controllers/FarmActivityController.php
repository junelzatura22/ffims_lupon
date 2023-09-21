<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\CityMun;
use App\Models\FarmDetails;
use App\Models\FarmerFisherfolk;
use App\Models\FixedLocation;
use App\Models\Program;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;

class FarmActivityController extends Controller
{
    //
    public function index($id)
    {
        $f2_id = FarmerFisherfolk::find($id);
        if (!empty($f2_id)) {
            $data['f2_data'] = $f2_id;
            //calling the location - fixed location of the user or head of office
            
            $citymun_id = FixedLocation::showMyLocation()->citymun_id;

          
            $data['identifier'] = "Welcome to " . $f2_id->fname . "'s - Farm Activity";
            $data['data'] = "F2 Activity - FFIMS Systems";
            $data['farmdetails'] = FarmDetails::getFarmDetailsOf($id, 'display');
            $data['programData'] = Program::showAllPrograms();
            return view('administrator.farm.activity', $data);
        } else {
            return back();
        }
    }
}
