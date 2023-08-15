<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //

    public function getLogin()
    {



        if (!empty(Auth::check())) {
            if (Auth::user()->role == "Administrator") {
                $data = "FFIMS | Administrator Dashboard";
                $identifier = "DASHBOARD";
                return view('administrator.dashboard', compact('data', 'identifier'));
            } else if (Auth::user()->role == "Technician") {
                $identifier = "DASHBOARD";
                $data = "FFIMS | Technician Dashboard";
                return view('technician.dashboard', compact('data', 'identifier'));
            } else if (Auth::user()->role == "Office Head") {
                $data = "FFIMS | Head Office Dashboard";
                $identifier = "DASHBOARD";
                return view('officehead.dashboard', compact('data', 'identifier'));
            } else {
                $identifier = "DASHBOARD";
                $data = "FFIMS | Guest Dashboard";
                return view('guest.dashboard', compact('data', 'identifier'));
            }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {

        try {
            DB::connection()->getPDO();
           
            $request->validate([
                'email' => "required|email",
                'password' => "required",
            ]);

            $credentials = ['email' => $request->email, 'password' => $request->password];
            $remember_token = $request->remembertoken;

            if (Auth::attempt($credentials, $remember_token)) {

                if (Auth::user()->role == "Administrator") {
                    return redirect('administrator/dashboard');
                } else if (Auth::user()->role == "Technician") {
                    return redirect('technician/dashboard');
                } else if (Auth::user()->role == "Office Head") {
                    return redirect('officehead/dashboard');
                } else {
                    return redirect('guest/dashboard');
                }
            } else {
                return redirect('/')->with('error', 'Invalid Username/Password!');
            }
        } catch (Exception $e) {
            echo 'Database connection failed...';
          
        }
        

    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect(url(''));
    }
}
