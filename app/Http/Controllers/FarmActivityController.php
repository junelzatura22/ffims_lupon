<?php

namespace App\Http\Controllers;

use App\Models\FarmActivity;
use App\Models\FarmDetails;
use App\Models\FarmerFisherfolk;
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

    public function storeActivity(Request $request)
    {
        $str =  explode("@",$request->program_id);
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
        return back()->with("success","Farm Activity was successfully added");
    }
}
