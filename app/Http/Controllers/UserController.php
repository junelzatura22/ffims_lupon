<?php

namespace App\Http\Controllers;

use App\Models\FixedLocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Str;
use Image;

class UserController extends Controller
{
    //

    public function index()
    {
      
        $data['users'] = User::showAllUsers();
        $data['identifier'] = "User | List";
        return view('administrator.user.index', $data);
    }
    public function createUser()
    {
        $data['mylocation'] = FixedLocation::myLocation();
        $data['identifier'] = "User | Create User";
        return view('administrator.user.addnew', $data);
    }
    public function getUserToUpdate($id)
    {
        $user = User::find($id);

        if (!empty($user)) {
            $data['userRecord'] = $user;
            $data['identifier'] = "User | Update User";
            return view('administrator.user.updateuser', $data);
        } else {
            return back();
        }
    }
    public function getUserStatus($id)
    {
        $user = User::find($id);

        if (!empty($user)) {
            $data['userRecord'] = $user;
            $data['identifier'] = "User | Change User Status";
            return view('administrator.user.statususer', $data);
        } else {
            return back();
        }
    }




    public function storeUser(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "lastname" => "required",
            "role" => "required",
            "designation" => "required",
            "contact" => "required|max:13|min:13",
        ], [
            "name" => "First Name is required!",
            "lastname" => "Last Name is required!",
            "role" => "Role is required!",
            "designation" => "Designation is Required",
            "contact" => "Please provide 11 digit number",
        ]);

        $user = new User();

        $filename = "";

        if ($request->hasFile('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $img = Image::make($file->getRealPath())->resize(300, 300);
            $img->save(public_path('asset/user/' . $filename));
        } else {
            $filename = "avatar.png";
        }
        $createdBy = Auth::user()->id;
        $name = strtoupper(trim($request->name));
        $lastname = strtoupper(trim($request->lastname));
        $email = $request->email;
        $role = $request->role;
        $contact = $request->contact;
        //
        $user->image = $filename;
        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->role = $role;
        $user->password = Hash::make('Pa$$w0rd!'); //default
        $user->created_by = $createdBy;
        $user->contact = $contact;
        $user->designation = $request->designation;
        $user->save();

        //get the user id
        $userId =  User::where('email',$email)->first();
        $location = new FixedLocation();
        $location->region_id = $request->region_id;
        $location->province_id = $request->province_id;
        $location->citymun_id = $request->citymun_id;
        $location->user_id = $userId->id;
        $location->save();


        return redirect()->route('user.index')->with('success', $name . ' was successfully added!');




    }
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "lastname" => "required",
            "role" => "required",
            "designation" => "required",
            "contact" => "required|max:13|min:13",
        ], [
            "name" => "First Name is required!",
            "lastname" => "Last Name is required!",
            "role" => "Role is required!",
            "designation" => "Designation is Required",
            "contact" => "Please provide 11 digit number",
        ]);

        $user = User::find($id);

        $filename = "";

        if ($request->hasFile('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $img = Image::make($file->getRealPath())->resize(300, 300);
            $img->save(public_path('asset/user/' . $filename));
            $user->image = $filename;
        } 
        
        $createdBy = Auth::user()->id;
        $name = strtoupper(trim($request->name));
        $lastname = strtoupper(trim($request->lastname));
        $email = $request->email;
        $role = $request->role;
        $contact = $request->contact;
        //
        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->role = $role;
        $user->created_by = $createdBy;
        $user->contact = $contact;
        $user->designation = $request->designation;
        $user->touch();
        return redirect()->route('user.index')->with('success', $name . ' was successfully updated!');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            "status" => "required", 
        ], [
            "status" => "Status Field is required!",
        ]);

        $user = User::find($id);
        $status = $request->status;
        //
        $user->status = $status;
        $user->touch();
        return redirect()->route('user.index')->with('success', $request->name . ' was successfully modified!');
    }
}
