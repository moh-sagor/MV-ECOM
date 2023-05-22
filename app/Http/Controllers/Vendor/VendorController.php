<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    function index()
    {
        return view('vendor.dashboard');
    }
    function login()
    {
        return view('vendor.vendorlogin');
    }
    function profile()
    {
        $vendorInfo = User::find(Auth::user()->id);
        return view('vendor.profile', compact('vendorInfo'));
    }
    function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('vendor/login');
    }

    function updateprofile(Request $request)
    {
        $vendorData = User::find(Auth::user()->id);
        $vendorData->name = $request->name;
        $vendorData->userName = $request->userName;
        $vendorData->phone = $request->phone;
        $vendorData->address = $request->address;
        $vendorData->email = $request->email;

        if ($request->image) {
            $image = $request->file('image');
            $customName = rand() . "." . $image->getClientOriginalExtension();
            @unlink(public_path('uploads/vendor/') . $vendorData->profile_pic);
            $image->move(public_path('uploads/vendor/'), $customName);
            $vendorData->profile_pic = $customName;
        }
        $vendorData->update();
        return back();
    }

    function changePassword()
    {
        return view('vendor.changepassword');
    }
    function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        //Find User
        $find = User::find(Auth::user()->id);
        //Password Match
        if (Hash::check($request->old_password, $find->password)) {
            $find->password = Hash::make($request->new_password);
            //Update Password
            $find->update();
            $notice = array(
                'message' => 'Password Change Successfully',
                'type' => 'info'
            );
            return back()->with($notice);
        } else {
            $notice = array(
                'message' => 'Old Password Does Not Match',
                'type' => 'warning'
            );
            return back()->with($notice);
        }
    }
}