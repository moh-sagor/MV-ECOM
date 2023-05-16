<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index()
    {
        return view('admin.dashboard');
    }
    function login()
    {
        return view('admin.adminlogin');
    }
    function profile()
    {
        $adminInfo = User::find(Auth::user()->id);
        return view('admin.profile', compact('adminInfo'));
    }
    function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

    function updateprofile(Request $request)
    {
        $adminData = User::find(Auth::user()->id);
        $adminData->name = $request->name;
        $adminData->userName = $request->userName;
        $adminData->phone = $request->phone;
        $adminData->address = $request->address;
        $adminData->email = $request->email;

        if ($request->image) {
            $image = $request->file('image');
            $customName = rand() . "." . $image->getClientOriginalExtension();
            @unlink(public_path('uploads/admin/') . $adminData->profile_pic);
            $image->move(public_path('uploads/admin/'), $customName);
            $adminData->profile_pic = $customName;
        }
        $adminData->update();
        return back();
    }

    function changePassword()
    {
        return view('admin.changepassword');
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