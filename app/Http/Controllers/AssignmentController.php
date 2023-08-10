<?php

namespace App\Http\Controllers;

use App\Models\AssignedBarangay;
use App\Models\AssignedProgram;
use App\Models\Barangay;
use App\Models\FixedLocation;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    //Assign to commodity
    public function ascomIndex()
    {
        $data['users'] = User::userHard();
        // $data['users'] = User::showAllUsers();
        $data['identifier'] = "User | User Assignment";
        return view('administrator.user.ascom', $data);
    }

    public function ascomCreMod($id)
    {

        $userData = User::find($id);
        if (!empty($userData)) {
            $data['program'] = Program::loadProgram();
            $data['asPro'] = AssignedProgram::showAllProgram($id);
            $data['asBar'] = AssignedBarangay::showBarangaAssignment($id);

            $data['region'] = FixedLocation::showLocationByUserId($id)->region;
            $data['province'] = FixedLocation::showLocationByUserId($id)->province;
            $data['citymun'] = FixedLocation::showLocationByUserId($id)->citymun; 
            $citymun_id = FixedLocation::showLocationByUserId($id)->citymun_id;
            //load all the barangays from this municipality
            $data['barangay'] = Barangay::showBarangayByMunicipality($citymun_id);

            $data['users'] = $userData;
            $data['identifier'] = "User | Add or Update user assignment";
            return view('administrator.user.ascomcremod', $data);
        } else {
            return back();
        }
    }

    public function updatestatus($id)
    {
        $userData = AssignedProgram::find($id);
        $getCurrentStatus = $userData->ac_status;
        $status = "";
        if ($getCurrentStatus == "Active") {
            $status = "Inactive";
        } else {
            $status = "Active";
        }
        $userData->ac_status = $status;
        $userData->touch();
        return response()->json(['success' => 'Status was successfully modified to ' . $status]);
    }

    public function deletestatus($id)
    {
        $userData = AssignedProgram::find($id);
        $userData->delete();
        return response()->json(['success' => 'Status was successfully removed!']);
    }



    public function getcom(Request $request, $id)
    {
        $request->validate([
            'ac_program_id' => "required",
        ], [
            'ac_program_id.required' => "Select Program!",
        ]);

        $data = AssignedProgram::where(['ac_userd_id' => $id, 'ac_program_id' => $request->ac_program_id])->first();
        if ($data === null) {

            $assignedCom = new AssignedProgram();
            $assignedCom->ac_userd_id = $id;
            $assignedCom->ac_program_id = $request->ac_program_id;
            $assignedCom->ac_createdby = Auth::user()->id;
            $assignedCom->save();
            return redirect()->route('user.getcommodity', ['id' => $id])->with('success', 'Program successfully assigned!');
        } else {
            return redirect()->route('user.getcommodity', ['id' => $id])->with('error', 'Program Already in the list!');
        }
    }


    //Store barangay assignment data
    public function storeBarAssigned(Request $request, $id)
    {
        $request->validate([
            'ab_bar_id' => "required",
        ], [
            'ab_bar_id.required' => "Select Barangay!",
        ]);

        $data = AssignedBarangay::where(['ab_user_id' => $id, 'ab_bar_id' => $request->ab_bar_id])->first();
        if ($data === null) {
            $assignedBarangay = new AssignedBarangay();
            $assignedBarangay->ab_user_id = $id;
            $assignedBarangay->ab_bar_id = $request->ab_bar_id;
            $assignedBarangay->ab_createdby = Auth::user()->id;
            $assignedBarangay->save();
            return redirect()->route('user.getcommodity', ['id' => $id])->with('success', 'Barangay successfully assigned!');
        } else {
            return redirect()->route('user.getcommodity', ['id' => $id])->with('error', 'Barangay Already in the list!');
        }
    }
}
