<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Barangay;
use App\Models\CityMun;
use App\Models\FarmerFisherfolk;
use App\Models\FFDetails;
use App\Models\FixedLocation;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Str;
use Image;

class FarmerFisherFolkController extends Controller
{
    //

    public function index()
    {
        $data['f2'] = FarmerFisherfolk::showFarmerFisherfolk();
        $data['identifier'] = "Farmer and Fisherfolk List";
        $data['data'] = "F2 List - FFIMS Systems";
        return view('administrator.f2.list', $data);
    }
    public function information($id)
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
            $data['identifier'] = "Welcome to ".$f2_id->fname."'s - Personal Information";
            $data['data'] = "F2 Information - FFIMS Systems";
            return view('administrator.f2.information', $data);
        } else {
            return back();
        }
    }
    public function details($id)
    {
        $f2_id = FarmerFisherfolk::find($id);
        if (!empty($f2_id)) {
            $data['f2_data'] = $f2_id;
            $data['association'] = Association::showAllAssociationsWithNone();
            $data['f2_details'] = FFDetails::showDetailsByF2($id);
            $data['identifier'] = "Welcome to ".$f2_id->fname."'s - other details";
            $data['data'] = "F2 Details - FFIMS Systems";
            return view('administrator.f2.details', $data);
        } else {
            return back();
        }
    }
    public function create()
    {
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
        $data['identifier'] = "Create Farmer and Fisherfolk Form";
        //load all the barangays from this municipality
        $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
        //
        $data['data'] = "F2 Register - FFIMS Systems";
        return view('administrator.f2.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "reg_type" => "required",
            "fname" => "required",
            "lname" => "required",
            "dob" => "required",
            "pob" => "required",
            "gender" => "required",
            "civilstatus" => "required",
            "name_of_spouse" => "required",
            "mothers_maidenname" => "required",
            "contactno" => "required",
            "a_purok" => "required",
            "a_sitio" => "required",
            "a_barangay" => "required",
        ], [
            "reg_type" => "Select Registration Type",
            "fname" => "Firstname field is required",
            "lname" => "Lastname field is required",
            "dob" => "Date of Birth is required",
            "pob" => "Place of Birth is required",
            "gender" => "Gender is required",
            "civilstatus" => "Civil Status is required",
            "name_of_spouse" => "Spouse field is required",
            "mothers_maidenname" => "Mothers Maiden is required",
            "contactno" => "Contact is required",
            "a_purok" => "House/Lot/Bldg. No/Purok is required",
            "a_sitio" => "Street/Sition/Subdv is required",
            "a_barangay" => "Barangay is required",
        ]);
        $f2 = new FarmerFisherfolk();
        $f2->reg_type = $request->reg_type;
        $f2->rsbsa_nat = empty($request->rsbsa_nat) ? '11-25-07-000-000000' : $request->rsbsa_nat;
        $f2->rsbsa_loc = empty($request->rsbsa_loc) ? '11-25-07-000-000000' : $request->rsbsa_loc;
        $f2->fishr_nat = empty($request->fishr_nat) ? '----' : $request->fishr_nat;
        $f2->fishr_loc =  empty($request->fishr_loc) ? '----' : $request->fishr_loc;
        $f2->fname = $request->fname;
        $f2->mname = empty($request->mname) ? '.' : $request->mname;
        $f2->lname = $request->lname;
        $f2->extname = empty($request->extname) ? '[Select]' : $request->extname;
        $f2->dob = $request->dob;
        $f2->pob = $request->pob;
        $f2->gender = $request->gender;
        $f2->civilstatus = $request->civilstatus;
        $f2->name_of_spouse = $request->name_of_spouse;
        $f2->mothers_maidenname = $request->mothers_maidenname;
        $f2->contactno = $request->contactno;
        $f2->email = empty($request->email) ? '.' : $request->email;
        //start - image
        $filename = "";
        if ($request->hasFile('picture')) {
            $ext = $request->file('picture')->getClientOriginalExtension();
            $file = $request->file('picture');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $img = Image::make($file->getRealPath())->resize(300, 300);
            $img->save(public_path('asset/f2/' . $filename));
        } else {
            $filename = "avatar.png";
        }
        $f2->picture = $filename;
        //end - image
        $f2->a_purok = trim($request->a_purok);
        $f2->a_sitio = trim($request->a_sitio);
        $f2->a_region = FixedLocation::showMyLocation()->region_id;
        $f2->a_province = FixedLocation::showMyLocation()->province_id;
        $f2->a_citymun = FixedLocation::showMyLocation()->citymun_id;
        $f2->a_barangay = $request->a_barangay;
        $f2->created_by = Auth::user()->id;
        $f2->save();
        //get the user id
        $ffId = FarmerFisherfolk::getId($f2->fname, $f2->lname, $f2->dob)->ff_id;
        //auto add the  other details
        $ffDetails = new FFDetails();

        $ffDetails->ff_id = $ffId;
        $ffDetails->education = "None";
        $ffDetails->religion = "Others";
        $ffDetails->others_religion = "None";
        $ffDetails->is_house_head = "No";
        $ffDetails->name_househead = "None";
        $ffDetails->relationship = "Others";
        $ffDetails->num_of_household = 0;
        $ffDetails->no_male = 0;
        $ffDetails->no_female = 0;
        $ffDetails->is_pwd = "No";
        $ffDetails->is_4ps = "No";
        $ffDetails->is_ip = "No";
        $ffDetails->name_of_group = "None";
        $ffDetails->with_gov_id = "None";
        $ffDetails->id_type = "No ID";
        $ffDetails->id_number = "000000000000";
        $ffDetails->is_assoc_member = "None";
        $ffDetails->assoc_id = 14; //this is the default id of association
        $ffDetails->contact_person = "None";
        $ffDetails->contact_number = "0000-000-0000";
        $ffDetails->contact_relation = "None";
        $ffDetails->created_by = Auth::user()->id;
        $ffDetails->save();


        return redirect()->route('f2.information', $ffId)->with('success', $f2->fname . ' was successfully added!');
    }
}
