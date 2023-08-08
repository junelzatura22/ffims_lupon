<?php

namespace App\Http\Controllers;

use App\Models\CityMun;
use App\Models\FixedLocation;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Location;
class LocationController extends Controller
{
    //

    public function index(){
        $data['mylocation'] = FixedLocation::showMyLocation();
        //load all regions
        $data['region'] = Region::showAllRegion();
        $data['identifier'] = "Location | User Location";
        //getting the ids
        $region_id = FixedLocation::showMyLocation()->region_id;
        $province_id = FixedLocation::showMyLocation()->province_id;
        $data['provinceData'] = Province::showProvinceByRegion($region_id);  
        $data['citymunData'] = CityMun::showCityMunByProvince($province_id);  
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

    public function store(Request $request){

        $request->validate([
            "region_id"=>"required",
            "province_id"=>"required",
            "citymun_id"=>"required",
        ]);

        $location = new FixedLocation();
        $location->region_id = $request->region_id;
        $location->province_id = $request->province_id;
        $location->citymun_id = $request->citymun_id;
        $location->user_id = Auth::user()->id;
        $location->save();
        return redirect()->back()->with('success',"Successfully set your location!");

    }

    public function update(Request $request){

        $request->validate([
            "region_id"=>"required",
            "province_id"=>"required",
            "citymun_id"=>"required",
        ],[
            "region_id.required"=>"Select Region",
            "province_id.required"=>"Select Province",
            "citymun_id.required"=>"Select Municipality",
        ]);

        $location =  FixedLocation::find($request->l_id);
        $location->region_id = $request->region_id;
        $location->province_id = $request->province_id;
        $location->citymun_id = $request->citymun_id;
        $location->user_id = Auth::user()->id;
        $location->touch();
        return redirect()->back()->with('success',"Successfully updated your location!");

    }

    // $data['citymun'] = City::where('provCode','=',$provCode)->get(['citymunDesc','citymunCode']);
    // return response()->json($data);
}
