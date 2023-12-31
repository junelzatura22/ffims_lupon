<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\AssociationProfile;
use App\Models\Barangay;
use App\Models\CityMun;
use App\Models\EntityVer;
use App\Models\FarmerFisherfolk;
use App\Models\FFDetails;
use App\Models\FixedLocation;
use App\Models\livelihood;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Str;

class FarmerFisherFolkController extends Controller
{
    //

    public function index()
    {
        $data['f2'] = FarmerFisherfolk::showFarmerFisherfolk();
        $data['identifier'] = "Farmer and Fisherfolk List";
        $data['data'] = "F2 List - FFIMS Systems";
        $citymun_id = FixedLocation::showMyLocation()->citymun_id;
        $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
        return view('administrator.f2.list', $data);
    }

    public function import()
    {
        // $data['f2'] = FarmerFisherfolk::showFarmerFisherfolk();
        $data['identifier'] = "Import Farmer and Fisherfolk Data";
        $data['data'] = "F2 Import - FFIMS Systems";
        $data['entityVer'] = EntityVer::where('is_loaded', '=', '0')->paginate(10);
        return view('administrator.f2.importfarmer', $data);
    }

    //temporary unused
    public function importExcel(Request $request)
    {
        // $request->validate([
        //     'file' => 'required',
        // ]);

        // /**
        //  * extracting the file
        //  * 1. Get the file
        //  * 2. Get the original file extension
        //  * 3. Set the filename
        //  * 4. Move the file upload with a new filename
        //  * 5. Get the full path and access it
        //  */
        // $file = $request->file;
        // $extension = $file->getClientOriginalExtension();
        // $fileName = time() . '.' . $extension;
        // $file->move(public_path() . '/asset/imports/', $fileName);
        // $path = public_path() . '/asset/imports/' . $fileName;
        // Excel::import(new FarmerfisherfolksImport(), $path);
        // return back()->with('success', "File uploaded successfully.");

        $data = EntityVer::find($request->id);

        foreach ($data as $key => $value) {
            // Decode the JSON
            $datas = json_decode($value, true);
            $enver = EntityVer::find($datas['id']);
            $enver->is_loaded = '1';
            $enver->save();
            //update the data set

            $f2 = new FarmerFisherfolk();
            $f2->reg_type = $datas['reg_type'];
            $f2->rsbsa_nat = $datas['rsbsa_nat'];
            $f2->rsbsa_loc = $datas['rsbsa_loc'];
            $f2->fishr_nat = $datas['fishr_nat'];
            $f2->fishr_loc = $datas['fishr_loc'];
            $f2->fname = $datas['fname'];
            $f2->mname = $datas['mname'];
            $f2->lname = $datas['lname'];
            $f2->extname = $datas['extname'];

            $date = explode("/",$datas['dob']);
            $year = $date[2];
            $month = $date[1];
            $day = $date[0];
            $dobs = $year.'-'.$day.'-'.$month;

            // $f2->dob = $datas['dob'];
            $f2->dob = $dobs;
            //
            $f2->pob = $datas['pob'];
            $f2->gender = $datas['gender'];
            $f2->civilstatus = "None";
            $f2->name_of_spouse = "None";
            $f2->mothers_maidenname = "None";
            $f2->contactno = $datas['contactno'];
            $f2->email = "None";
            $f2->picture = "avatar.png";
            $f2->a_purok = "None";
            $f2->a_sitio = "None";
            $f2->a_region = $datas['a_region'];
            $f2->a_province = $datas['a_province'];
            $f2->a_citymun = $datas['a_citymun'];
            $f2->a_barangay = $datas['a_barangay'];
            $f2->created_by = Auth::user()->id;
            $f2->save();
            //get the user id
            $ffId = FarmerFisherfolk::getId($f2->fname, $f2->lname, $f2->dob)->ff_id;
            //auto add the  other details
            $ffDetails = new FFDetails();

            $ffDetails->ff_id = $ffId;
            $ffDetails->education = "Nones";
            $ffDetails->religion = "None";
            $ffDetails->others_religion = "None";
            $ffDetails->is_house_head = "None";
            $ffDetails->name_househead = "None";
            $ffDetails->relationship = "None";
            $ffDetails->num_of_household = 0;
            $ffDetails->no_male = 0;
            $ffDetails->no_female = 0;
            $ffDetails->is_pwd = "None";
            $ffDetails->is_4ps = "None";
            $ffDetails->is_ip = "None";
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

            //auto saving the livelihood
            $livelihood = new livelihood();

            $livelihood->main_livelihood = '["None"]';
            $livelihood->crops_specify = "None";
            $livelihood->type_of_activity = '["None"]';
            $livelihood->livestock_specify = "None";
            $livelihood->poultry_specify = "None";
            $livelihood->kind_of_work = '["None"]';
            $livelihood->kind_of_work_others = "None";
            $livelihood->fishing_activity = '["None"]';
            $livelihood->fishing_activity_others = "None";
            $livelihood->involvement = '["None"]';
            $livelihood->involvement_others = "None";
            $livelihood->income_farming = 0.0;
            $livelihood->income_non_farming = 0.0;
            $livelihood->created_by = Auth::user()->id;
            $livelihood->livelihoodby = $ffId;
            $livelihood->save();

        }

        return back()->with('success', "Done Data Added!");

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
            $data['identifier'] = "Welcome to " . $f2_id->fname . "'s - Personal Information";
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
            
            $data['identifier'] = "Welcome to " . $f2_id->fname . "'s - other details";
            $data['data'] = "F2 Details - FFIMS Systems";

            // if(empty(FFDetails::showDetailsByF2($id))){


            // }
            $data['f2_details'] = FFDetails::showDetailsByF2($id);


            return view('administrator.f2.details', $data);
        } else {
            return back();
        }
    }

    // display the livelihood components
    public function livelihood($id)
    {
        $f2_id = FarmerFisherfolk::find($id);
        if (!empty($f2_id)) {
            $data['f2_data'] = $f2_id;
            $data['livelihood'] = livelihood::showLivelihoodByF2($id);
            $data['identifier'] = "Welcome to " . $f2_id->fname . "'s - Livelihood Details";
            $data['data'] = "F2 Livelihood - FFIMS Systems";
            return view('administrator.f2.livelihood', $data);
        } else {
            return back();
        }
    }

    public function updateLivelihood($id, Request $request)
    {

        $request->validate([
            "main_livelihood" => "required",
            "type_of_activity" => "required",
            "crops_specify" => "required",
            "livestock_specify" => "required",
            "poultry_specify" => "required",
            "kind_of_work" => "required",
            "kind_of_work_others" => "required",
            "fishing_activity" => "required",
            "fishing_activity_others" => "required",
            "involvement" => "required",
            "involvement_others" => "required",
            "income_farming" => "required",
            "income_non_farming" => "required",
        ]);

        $l_id = livelihood::showLivelihoodByF2($id)->l_id; //get the ID by user
        $livelihood = livelihood::find($l_id);

        $livelihood->main_livelihood = json_encode($request->main_livelihood);
        $livelihood->crops_specify = empty($request->crops_specify) ? "None" : strtoupper(trim($request->crops_specify));
        $livelihood->type_of_activity = json_encode($request->type_of_activity);
        $livelihood->livestock_specify = empty($request->livestock_specify) ? "None" : strtoupper(trim($request->livestock_specify));
        $livelihood->poultry_specify = empty($request->poultry_specify) ? "None" : strtoupper(trim($request->poultry_specify));
        $livelihood->kind_of_work = json_encode($request->kind_of_work);
        $livelihood->kind_of_work_others = empty($request->kind_of_work_others) ? "None" : strtoupper(trim($request->kind_of_work_others));
        $livelihood->fishing_activity = json_encode($request->fishing_activity);
        $livelihood->fishing_activity_others = empty($request->fishing_activity_others) ? "None" : strtoupper(trim($request->fishing_activity_others));
        $livelihood->involvement = json_encode($request->involvement);
        $livelihood->involvement_others = empty($request->involvement_others) ? "None" : strtoupper(trim($request->involvement_others));
        $livelihood->income_farming = empty($request->income_farming) ? 0.0 : $request->income_farming;
        $livelihood->income_non_farming = empty($request->income_non_farming) ? 0.0 : $request->income_non_farming;
        $livelihood->created_by = Auth::user()->id;
        $livelihood->touch();

        return back()->with('success', 'Livelihood details was successfully saved!');
        // dd($request->all());
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
        $f2->fishr_loc = empty($request->fishr_loc) ? '----' : $request->fishr_loc;
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
        $ffDetails->education = "Nones";
        $ffDetails->religion = "None";
        $ffDetails->others_religion = "None";
        $ffDetails->is_house_head = "None";
        $ffDetails->name_househead = "None";
        $ffDetails->relationship = "None";
        $ffDetails->num_of_household = 0;
        $ffDetails->no_male = 0;
        $ffDetails->no_female = 0;
        $ffDetails->is_pwd = "None";
        $ffDetails->is_4ps = "None";
        $ffDetails->is_ip = "None";
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

        //auto saving the livelihood
        $livelihood = new livelihood();

        $livelihood->main_livelihood = '["None"]';
        $livelihood->crops_specify = "None";
        $livelihood->type_of_activity = '["None"]';
        $livelihood->livestock_specify = "None";
        $livelihood->poultry_specify = "None";
        $livelihood->kind_of_work = '["None"]';
        $livelihood->kind_of_work_others = "None";
        $livelihood->fishing_activity = '["None"]';
        $livelihood->fishing_activity_others = "None";
        $livelihood->involvement = '["None"]';
        $livelihood->involvement_others = "None";
        $livelihood->income_farming = 0.0;
        $livelihood->income_non_farming = 0.0;
        $livelihood->created_by = Auth::user()->id;
        $livelihood->livelihoodby = $ffId;
        $livelihood->save();

        return redirect()->route('f2.information', $ffId)->with('success', $f2->fname . ' was successfully added!');
    }

    public function update(Request $request, $id)
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
            "ff_status" => "required",
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
            "ff_status" => "Status is required",
        ]);
        $f2 = FarmerFisherfolk::find($id);
        $f2->reg_type = $request->reg_type;
        $f2->rsbsa_nat = empty($request->rsbsa_nat) ? '11-25-07-000-000000' : $request->rsbsa_nat;
        $f2->rsbsa_loc = empty($request->rsbsa_loc) ? '11-25-07-000-000000' : $request->rsbsa_loc;
        $f2->fishr_nat = empty($request->fishr_nat) ? '----' : $request->fishr_nat;
        $f2->fishr_loc = empty($request->fishr_loc) ? '----' : $request->fishr_loc;
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
            $filename = $request->imageHolder;
        }
        $f2->picture = $filename;
        //end - image
        $f2->a_purok = trim($request->a_purok);
        $f2->a_sitio = trim($request->a_sitio);
        $f2->a_region = FixedLocation::showMyLocation()->region_id;
        $f2->a_province = FixedLocation::showMyLocation()->province_id;
        $f2->a_citymun = FixedLocation::showMyLocation()->citymun_id;
        $f2->a_barangay = $request->a_barangay;
        $f2->ff_status = $request->ff_status;
        $f2->created_by = Auth::user()->id;
        $f2->touch();

        return back()->with('success', $f2->fname . ' was successfully modified!');
    }

    public function updateDetails(Request $request, $id)
    {
        $request->validate([
            "education" => "required",
            "religion" => "required",
            "is_house_head" => "required",
            "name_househead" => "required",
            "relationship" => "required",
            "num_of_household" => "required",
            "no_male" => "required",
            "no_female" => "required",
            "is_pwd" => "required",
            "is_4ps" => "required",
            "is_ip" => "required",

            "with_gov_id" => "required",
            "id_type" => "required",
            "id_number" => "required",
            "is_assoc_member" => "required",
            "assoc_id" => "required",
            "contact_person" => "required",
            "contact_number" => "required",
            "contact_relation" => "required",
        ], [
            "education" => "Education is required",
            "religion" => "Religion is required",
            "is_house_head" => "Household is required",
            "name_househead" => "Household name is required",
            "relationship" => "Relationship is required",
            "num_of_household" => "This field is required",
            "no_male" => "This field is required",
            "no_female" => "This field is required",
            "is_pwd" => "PWD is required",
            "is_4ps" => "4P's is required",
            "is_ip" => "IP is required",

            "with_gov_id" => "This field is required",
            "id_type" => "This field is required",
            "id_number" => "This field is required",
            "is_assoc_member" => "This field is required",
            "assoc_id" => "This field is required",
            "contact_person" => "Contact Person is required",
            "contact_number" => "Contact No. is required",
            "contact_relation" => "Contact Relationship is required",
        ]);

        $ffd_id = FFDetails::showDetailsByF2($id)->ffd_id;

        $ffDetails = FFDetails::find($ffd_id);

        $ffDetails->education = $request->education;
        $ffDetails->religion = $request->religion;
        $ffDetails->others_religion = empty($request->others_religion) ? "None" : strtoupper(trim($request->others_religion));
        $ffDetails->is_house_head = $request->is_house_head;
        $ffDetails->name_househead = empty($request->name_househead) ? "None" : strtoupper(trim($request->name_househead));
        $ffDetails->relationship = $request->relationship;
        $ffDetails->num_of_household = $request->num_of_household;
        $ffDetails->no_male = $request->no_male;
        $ffDetails->no_female = $request->no_female;
        $ffDetails->is_pwd = $request->is_pwd;
        $ffDetails->is_4ps = $request->is_4ps;
        $ffDetails->is_ip = $request->is_ip;
        $ffDetails->name_of_group = empty($request->name_of_group) ? "None" : strtoupper(trim($request->name_of_group));
        $ffDetails->with_gov_id = $request->with_gov_id;
        $ffDetails->id_type = $request->id_type;
        $ffDetails->id_number = $request->id_number;
        $ffDetails->is_assoc_member = $request->is_assoc_member;
        $ffDetails->assoc_id = 14; //disable this function
        $ffDetails->contact_person = $request->contact_person;
        $ffDetails->contact_number = $request->contact_number;
        $ffDetails->contact_relation = $request->contact_relation;
        $ffDetails->created_by = Auth::user()->id;
        $ffDetails->touch();

        if ($request->assoc_id != 0) {
            $associationProfile = new AssociationProfile();
            $associationProfile->assoc_id = $request->assoc_id;
            $associationProfile->entity = $id;
            $associationProfile->membersince = "0000";
            $associationProfile->status = "Active";
            $associationProfile->register_by = Auth::user()->id;
            $associationProfile->save();
        }

        return back()->with('success', 'Detailed was successfully updated!');
    }
}
