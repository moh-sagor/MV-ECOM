<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Image;
use File;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    function index()
    {
        $userData = User::find(Auth::User()->id);

        return view('index', compact("userData"));
    }
    function updateuser(Request $request)
    {
        $userData = User::find(Auth::User()->id);
        if ($request->image) {
            if (File::exists(public_path('uploads/user/') . $userData->profile_pic)) {
                File::delete(public_path('uploads/user/' . $userData->profile_pic));
            }
            $image = $request->file('image');
            $imageName = rand() . "." . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/user/' . $imageName);
            Image::make($image)->resize(150, 150)->save($imagePath);
            $userData->profile_pic = $imageName;
        }
        $userData->name = $request->name;
        $userData->userName = $request->userName;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
        $userData->address = $request->address;
        $userData->update();
        return back();

    }
    function userlogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }
}