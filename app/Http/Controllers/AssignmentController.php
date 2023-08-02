<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;

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

        $userData  = User::find($id);
        if (!empty($userData)) {
            $data['program'] = Program::loadProgram();
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
            'commodity' => "required"
        ]);

        foreach ($request->commodity as $key => $value) {
           
        }
    }
}
