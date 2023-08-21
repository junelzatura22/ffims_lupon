<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Barangay;
use App\Models\FixedLocation;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RBOController extends Controller
{
    //
    public function index()
    {
        $data['identifier'] = "RBO | RBO List";
        $data['data'] = "RBO List - FFIMS Systems";
        return view('administrator.rbo.list', $data);
    }
    public function cluster()
    {
        $data['data'] = "Cluster - FFIMS Systems";
        $data['identifier'] = "RBO | RBO List of Cluster";
        return view('administrator.rbo.cluster', $data);
    }
    public function association()
    {
        $data['data'] = "Association - FFIMS Systems";
        $data['association'] = Association::showAllAssociations();
        $data['identifier'] = "RBO | RBO List of Association";
        return view('administrator.rbo.association', $data);
    }

    //Creating association
    public function createAssociation()
    {
        //get the current location of the user
        $data['region'] = FixedLocation::showLocationByUserId(Auth::user()->id)->region; //region name
        $data['province'] = FixedLocation::showLocationByUserId(Auth::user()->id)->province; //province
        $data['citymun'] = FixedLocation::showLocationByUserId(Auth::user()->id)->citymun; //city or municipality

        $citymun_id = FixedLocation::showLocationByUserId(Auth::user()->id)->citymun_id;
        //load all the barangays from this municipality
        $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
        $data['program'] = Program::loadProgram();
        // $data['location'] = FixedLocation::myLocation();
        $data['identifier'] = "RBO | Register Association";
        $data['data'] = "Register Association - FFIMS Systems";
        return view('administrator.rbo.createass', $data);
    }
    //Creating association
    public function storeAssociation(Request $request)
    {
        $request->validate([
            "nameabbr" => "required|unique:association",
            "namedesc" => "required|unique:association",
            "isreg_to" => "required",
            "registration_no" => "required",
            "dataregistered" => "required",
            "belongs_to_program" => "required",
            "barangay_id" => "required",
        ], [
            "nameabbr.required" => "Field is required",
            "nameabbr.unique" => "Already exist association name.",
            "namedesc.required" => "Field is required",
            "namedesc.unique" => "Already exist association description.",
            "isreg_to.required" => "Field is requiredField is required",
            "registration_no.required" => "Field is required",
            "dataregistered.required" => "Field is required",
            "belongs_to_program.required" => "Please select commodity",
            "barangay_id.required" => "Please select Barangay",
        ]);


        $association = new Association();
        $association->nameabbr = trim(strtoupper($request->nameabbr));
        $association->namedesc = trim(strtoupper($request->namedesc));
        $association->isreg_to = $request->isreg_to;
        $association->registration_no = trim(strtoupper($request->registration_no));
        $association->dataregistered = $request->dataregistered;
        $association->belongs_to_program = $request->belongs_to_program;
        $association->barangay_id = $request->barangay_id;
        $association->as_status = "Active";
        $association->created_by = Auth::user()->id;
        //Use the data of fixed location === For Municipal Data Only
        $association->region_id = FixedLocation::myLocation()->region_id;
        $association->province_id = FixedLocation::myLocation()->province_id;
        $association->citymun_id = FixedLocation::myLocation()->citymun_id;
        $association->save();
        return redirect()->route('rbo.association')->with('success', $association->nameabbr . ", was successfully added!");
    }
    public function update($id)
    {

        $association = Association::find($id);
        if (!empty($association)) {

            $data['association'] = $association;
            $data['region'] = FixedLocation::showLocationByUserId(Auth::user()->id)->region; //region name
            $data['province'] = FixedLocation::showLocationByUserId(Auth::user()->id)->province; //province
            $data['citymun'] = FixedLocation::showLocationByUserId(Auth::user()->id)->citymun; //city or municipality

            $citymun_id = FixedLocation::showLocationByUserId(Auth::user()->id)->citymun_id;
            //load all the barangays from this municipality
            $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);
            $data['program'] = Program::loadProgram();

            // $data['location'] = FixedLocation::myLocation();
            $data['identifier'] = "RBO | Update Association";
            $data['data'] = "Update Association - FFIMS Systems";
            return view('administrator.rbo.updateass', $data);
        } else {
            return redirect()->back();
        }    
    }
    public function updateAssociation(Request $request, $id)
    {
        //
        $association = Association::find($id);
        //
        $association->nameabbr = trim(strtoupper($request->nameabbr));
        $association->namedesc = trim(strtoupper($request->namedesc));
        $association->isreg_to = $request->isreg_to;
        $association->registration_no = trim(strtoupper($request->registration_no));
        $association->dataregistered = $request->dataregistered;
        $association->belongs_to_program = $request->belongs_to_program;
        $association->barangay_id = $request->barangay_id;
        //
        $association->created_by = Auth::user()->id;
        //Use the data of fixed location === For Municipal Data Only
        $association->touch();
        return redirect()->route('rbo.association')->with('success', $association->nameabbr . ", was successfully updated!");
    }

    public function updateStatus($id)
    {
        $associationData = Association::find($id);
        $getCurrentStatus = $associationData->as_status;
        $status = "";
        if ($getCurrentStatus == "Active") {
            $status = "Inactive";
        } else {
            $status = "Active";
        }
        $associationData->as_status = $status;
        $associationData->touch();
        return response()->json(['success' => 'Status was successfully modified to ' . $status]);
    }
}
