<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\CityMun;
use App\Models\FarmerFisherfolk;
use App\Models\FixedLocation;
use App\Models\Province;
use App\Models\Region;
use GeoIp2\Model\City;
use Illuminate\Http\Request;

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
            //calling the location - fixed location of the user or head of office
            // $data['mylocation'] = FixedLocation::showMyLocation(); //show the current fixed location of the user
            // $data['region'] = Region::showAllRegion();
            //getting the ids
            // $region_id = FixedLocation::showMyLocation()->region_id;
            // $province_id = FixedLocation::showMyLocation()->province_id;
            $citymun_id = FixedLocation::showMyLocation()->citymun_id;
            //load all the barangays from this municipality
            $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
            $data['identifier'] = $f2_id->fname . "'s - Farm Details (register area)";
            $data['data'] = "F2 Farm Details - FFIMS Systems";
            return view('administrator.farm.createarea', $data);
        } else {
            return back();
        }
    }


}
