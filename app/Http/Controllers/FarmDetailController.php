<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\CityMun;
use App\Models\FarmDetails;
use App\Models\FarmerFisherfolk;
use App\Models\FixedLocation;
use App\Models\Province;
use App\Models\Region;
use GeoIp2\Model\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmDetailController extends Controller
{
    //

    public function index($id)
    {
        $f2_id = FarmerFisherfolk::find($id);
        if (!empty($f2_id)) {
            $data['f2_data'] = $f2_id;
            //calling the location - fixed location of the user or head of office
            $data['mylocation'] = FixedLocation::showMyLocation(); //show the current fixed location of the user
            $data['region'] = Region::showAllRegion();
            //getting the ids
            $region_id = FixedLocation::showMyLocation()->region_id;
            $province_id = FixedLocation::showMyLocation()->province_id;
            $citymun_id = FixedLocation::showMyLocation()->citymun_id;
            //
            $data['provinceData'] = Province::showProvinceByRegion($region_id);
            $data['citymunData'] = CityMun::showCityMunByProvince($province_id);
            //
            //load all the barangays from this municipality
            $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
            $data['identifier'] = "Welcome to " . $f2_id->fname . "'s - Farm Details";
            $data['data'] = "F2 Farm Details - FFIMS Systems";
            //load the farm details
            $data['farmdetails'] = FarmDetails::getFarmDetailsOf($id, 'display');
            $data['sum_area'] = FarmDetails::getFarmDetailsOf($id, 'sum_area');
            $data['sum_parcel'] = FarmDetails::getFarmDetailsOf($id, 'sum_parcel');
            $data['count_farm_active'] = FarmDetails::getFarmDetailsOf($id, 'count_farm_active');
            return view('administrator.farm.farmdetails', $data);
        } else {
            return back();
        }
    }
    public function registerFarmDetails($id)
    {
        $f2_id = FarmerFisherfolk::find($id);
        if (!empty($f2_id)) {
            $data['f2_data'] = $f2_id;
            $citymun_id = FixedLocation::showMyLocation()->citymun_id;
            $data['noOfFarms'] = FarmDetails::getFarmDetailsOf($id, 'count');
            $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
            $data['identifier'] = $f2_id->fname . "'s - Farm Details (register area)";
            $data['data'] = "F2 Farm Details - FFIMS Systems";
            return view('administrator.farm.createarea', $data);
        } else {
            return back();
        }
    }

    //get the farm details to update
    public function getFarmDetails($id)
    {
        $fdetails = FarmDetails::find($id);
        if (!empty($fdetails)) {
            $data['f2_data'] = FarmerFisherfolk::find($fdetails->registered_to);
            $citymun_id = FixedLocation::showMyLocation()->citymun_id;
            $data['identifier'] = "Update " . $fdetails->farm_name . "'s farm details";
            $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
            $data['data'] = "F2 Farm Details - FFIMS Systems";
            $data['farmDetails'] = $fdetails;
            return view('administrator.farm.updatearea', $data);
        } else {
            return back();
        }
    }

    public function storeFarmDetails($id, Request $request)
    {
        $request->validate(
            [
                "farm_name" => "required",
                "no_of_parcel" => "required",
                "total_area" => "required",
                "ownership_type" => "required",
                "name_of_owner" => "required|array|min:1",
                "name_of_owner.*" => "required|string|min:1",
                "location_bar_id" => "required",
                "location_purok" => "required",
            ],
            [
                "farm_name" => "This field is required",
                "no_of_parcel" => "This field is required",
                "total_area" => "This field is required",
                "ownership_type" => "This field is required",
                "name_of_owner" => "This field is required",
                "name_of_owner.*" => "This field is required",
                "location_bar_id" => "This field is required",
                "location_purok" => "This field is required",
            ]
        );
        $farmDetails = new FarmDetails();
        $citymun_id = FixedLocation::showMyLocation()->citymun_id;
        $farmDetails->farm_name = $request->farm_name;
        $farmDetails->no_of_parcel = (int)$request->no_of_parcel;
        $farmDetails->total_area = $request->total_area;
        $farmDetails->ownership_type = $request->ownership_type;
        $farmDetails->name_of_owner = strtoupper(json_encode($request->name_of_owner));
        $farmDetails->lat = empty($request->lat) ? "0.000000" :  $request->lat;
        $farmDetails->long = empty($request->long) ? "0.000000" : $request->long;
        $farmDetails->location_purok = trim($request->location_purok);
        $farmDetails->location_bar_id = $request->location_bar_id;
        $farmDetails->location_mun_id = $citymun_id;
        $farmDetails->registered_to = $id;
        $farmDetails->created_by = Auth::user()->id;
        $farmDetails->save();
        return redirect()->route('f2.farm', $id)->with("success", "Farm Area was successfully added!");
    }
    public function updateFarmDetails($id, Request $request)
    {
        $request->validate(
            [
                "farm_name" => "required",
                "no_of_parcel" => "required",
                "total_area" => "required",
                "ownership_type" => "required",
                "name_of_owner" => "required|array|min:1",
                "name_of_owner.*" => "required|string|min:1",
                "location_bar_id" => "required",
                "location_purok" => "required",
            ],
            [
                "farm_name" => "This field is required",
                "no_of_parcel" => "This field is required",
                "total_area" => "This field is required",
                "ownership_type" => "This field is required",
                "name_of_owner" => "This field is required",
                "name_of_owner.*" => "This field is required",
                "location_bar_id" => "This field is required",
                "location_purok" => "This field is required",
            ]
        );


        $farmDetails = FarmDetails::find($id); //farm id
        $farmDetails->farm_name = $request->farm_name;
        $farmDetails->no_of_parcel = (int)$request->no_of_parcel;
        $farmDetails->total_area = $request->total_area;
        $farmDetails->ownership_type = $request->ownership_type;
        $farmDetails->name_of_owner = strtoupper(json_encode($request->name_of_owner));
        $farmDetails->lat = empty($request->lat) ? "0.000000" :  $request->lat;
        $farmDetails->long = empty($request->long) ? "0.000000" : $request->long;
        $farmDetails->location_purok = trim($request->location_purok);
        $farmDetails->location_bar_id = $request->location_bar_id;
        $farmDetails->created_by = Auth::user()->id;
        $farmDetails->touch();
        return redirect()->route('f2.getfarmdetails', $id)->with("success", $farmDetails->farm_name . " was successfully updated!");
    }
    public function updateFarmStatus($id)
    {
        $farmDetails = FarmDetails::find($id); //farm id
        $currentFarmStatus =  $farmDetails->farm_status; //get the current farm status
        $newFarmstatus = $currentFarmStatus == "Active" ? "Inactive" : "Active";
        $farmDetails->farm_status = $newFarmstatus;
        $farmDetails->touch();
        return response()->json(['success' => 'status is modified']);
    }
}
