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
            $data['data'] = "Admin Dashboard - FFIMS Systems";
            return view('administrator.dashboard', $data);
        } else if (Auth::user()->role == "Technician") {
            $data['data'] = "Technician Dashboard - FFIMS Systems";

            return view('technician.dashboard', $data);
        } else if (Auth::user()->role == "Office Head") {

            $data['data'] = "Office Head Dashboard - FFIMS Systems";
            return view('officehead.dashboard', $data);
        } else {

            $data['data'] = "Guest Dashboard - FFIMS Systems";
            return view('guest.dashboard', $data);
        }


        return view('auth.login');
    }
}
