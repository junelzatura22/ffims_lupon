<?php

namespace App\Http\Controllers;

use App\Models\AssignedProgram;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    //Assign to commodity
    public function ascomIndex()
    {
        $data['users'] = User::showAllUsers();
        $data['identifier'] = "User | User Assignment";
        return view('administrator.user.ascom', $data);
    }

    public function ascomCreMod($id)
    {

        $userData = User::find($id);
        if (!empty($userData)) {
            $data['program'] = Program::loadProgram();
            $data['asPro'] = AssignedProgram::showAllProgram($id);
            $data['countProgram'] = AssignedProgram::countProgram($id);
            $data['users'] = $userData;
            $data['identifier'] = "User | Add or Update user assignment";
            return view('administrator.user.ascomcremod', $data);
        } else {
            return back();
        }
    }

    public function getcom(Request $request, $id)
    {
        $request->validate([
            'commodity' => "required",
        ]);

        

        foreach ($request->commodity as $key => $value) {
            $assignedCom = new AssignedProgram();
            $assignedCom->ac_userd_id = $id;
            $assignedCom->ac_program_id = $value;
            $assignedCom->ac_createdby = Auth::user()->id;
            $assignedCom->save();
        }
        return redirect()->route('user.getcommodity',['id'=>$id])->with('success', 'Program successfully assigned!');
    }
}
