<?php

namespace App\Http\Controllers;

use App\Models\FarmActivity;
use App\Models\FarmDetails;
use App\Models\FarmerFisherfolk;
use App\Models\ProgamCategory;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmActivityController extends Controller
{
    //
    public function index($id)
    {
        $f2_id = FarmerFisherfolk::find($id);
        if (!empty($f2_id)) {
            $data['f2_data'] = $f2_id;
            //calling the location - fixed location of the user or head of office

            $data['identifier'] = "Welcome to " . $f2_id->fname . "'s - Farm Activity";
            $data['data'] = "F2 Activity - FFIMS Systems";
            $data['farmdetails'] = FarmDetails::getFarmDetailsOf($id, 'display');
            $data['programData'] = Program::showAllPrograms();
            return view('administrator.farm.activity', $data);
        } else {
            return back();
        }
    }

    public function createActivity($id, $fid)
    {
        $f2_id = FarmerFisherfolk::find($id);
        //Is will check if the farm exist with the 
        $isFarmExist = FarmDetails::showFarmDetailsByID($id, $fid);

        if (!empty($isFarmExist)) {
            $data['f2_data'] = $f2_id;
            //calling the location - fixed location of the user or head of office
            $data['totalAreaRegistered'] = FarmActivity::getSumOfAreaByFarmID($fid);
            $data['identifier'] = "Welcome to " . $f2_id->fname . "'s - Farm Activity";
            $data['data'] = "F2 Activity - FFIMS Systems";
            $data['farmdetails'] = FarmDetails::showFarmDetailsByID($id, $fid); //display the farm details
            $data['programData'] = Program::showAllPrograms();
            return view('administrator.farm.createactivity', $data);
        } else {
            return back();
        }
    }
    public function updateactivity($id, $fid, $aid)
    {
        $f2_id = FarmerFisherfolk::find($id);
        //Is will check if the farm exist with the 
        $isFarmExist = FarmDetails::showFarmDetailsByID($id, $fid);
        //check if the farm activity existed
        $activity = FarmActivity::find($aid);
        if (!empty($isFarmExist)) {

            $data['f2_data'] = $f2_id;
            //calling the location - fixed location of the user or head of office
            $data['totalAreaRegistered'] = FarmActivity::getSumOfAreaByFarmID($fid);
            $data['identifier'] = "Welcome to " . $f2_id->fname . "'s - Farm Activity";
            $data['data'] = "F2 Activity - FFIMS Systems";
            $data['farmdetails'] = FarmDetails::showFarmDetailsByID($id, $fid); //display the farm details
            $data['programData'] = Program::showAllPrograms();
            $data['programCategory'] =  ProgamCategory::loadProgramCategory($activity->program_id);
            $data['activity'] = $activity;

            return view('administrator.farm.updateactivity', $data);
        } else {
            return back();
        }
    }

    public function storeActivity($id, Request $request)
    {
        $str =  explode("@", $request->program_id);
        $farmActivity = new FarmActivity();
        $farmActivity->program_id = $str[1];
        $farmActivity->pc_id = $request->pc_id;
        $farmActivity->area = $request->area;
        $farmActivity->hills = $request->hills;
        $farmActivity->no_of_heads = $request->no_of_heads;
        $farmActivity->farmtype = $request->farmtype;
        $farmActivity->is_organic = $request->is_organic;
        $farmActivity->remarks = $request->remarks;
        $farmActivity->register_by = Auth::user()->id;
        $farmActivity->farm_id = $request->farm_id;
        $farmActivity->save();
        return redirect()->route("f2.activity", $id)->with("success", "Farm Activity was successfully added");
    }
    public function getDataToUpdate($id, $fid, $aid, Request $request)
    {
        $farmActivity = FarmActivity::find($aid);
        $str =  explode("@", $request->program_id);
        $farmActivity->program_id = $str[1];
        $farmActivity->pc_id = $request->pc_id;
        $farmActivity->area = $request->area;
        $farmActivity->hills = $request->hills;
        $farmActivity->no_of_heads = $request->no_of_heads;
        $farmActivity->farmtype = $request->farmtype;
        $farmActivity->is_organic = $request->is_organic;
        $farmActivity->remarks = $request->remarks;
        $farmActivity->register_by = Auth::user()->id;
        $farmActivity->farm_id = $request->farm_id; //embedded to the form
        $farmActivity->touch();
        return redirect()->route("f2.activity", $id)->with("success", "Farm Activity was successfully added");
    
    }
}
