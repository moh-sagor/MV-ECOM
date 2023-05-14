<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}