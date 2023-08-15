<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\ProgamCategory;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {

       
            if (Auth::user()->role == "Administrator") {
                $data['identifier'] = "FFIMS | Administrator Dashboard";
                
                $data['totalPrograms'] = Program::where('program_status', '=', 'Active')->count();
                $data['totalTechnician'] = User::where(['status' => 'Active', 'role' => 'Technician'])->count();
                $data['totalAdministrator'] = User::where(['status' => 'Active', 'role' => 'Administrator'])->count();
                $data['totalGuest'] = User::where(['status' => 'Active', 'role' => 'Guest'])->count();
                $data['totalOfficeHead'] = User::where(['status' => 'Active', 'role' => 'Office Head'])->count();
                $data['totalProgramCategory'] = ProgamCategory::where('is_deleted', '=', '0')->count();
                $data['totalAssociationActive'] = Association::where('as_status', '=', 'Active')->count();
                $data['totalAssociationInactive'] = Association::where('as_status', '=', 'Inactive')->count();

                return view('administrator.dashboard', $data);
            } else if (Auth::user()->role == "Technician") {
                $data = "FFIMS | Technician Dashboard";
                return view('technician.dashboard', compact('data'));
            } else if (Auth::user()->role == "Office Head") {
                $data = "FFIMS | Office Head";
                return view('officehead.dashboard', compact('data'));
            } else {
                $data = "FFIMS | Guest Dashboard";
                return view('guest.dashboard', compact('data'));
            }
     
            
            return view('auth.login');

        
    }
}
