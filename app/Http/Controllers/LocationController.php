<?php

namespace App\Http\Controllers;

use App\Models\CityMun;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Location;
class LocationController extends Controller
{
    //

    public function index(){
        $data['region'] = Region::showAllRegion();  
        $data['identifier'] = "Location | User Location";
        return view('administrator.location.dashboard', $data);
    }

    public function showProvinceByRegion($id){
        $data['provinceData'] = Province::showProvinceByRegion($id);
        return response()->json($data); //return response to json
    }
    public function showCityMunByProvince($id){
        $data['citymunData'] = CityMun::showCityMunByProvince($id);
        return response()->json($data); //return response to json
    }

    // $data['citymun'] = City::where('provCode','=',$provCode)->get(['citymunDesc','citymunCode']);
    // return response()->json($data);
}
