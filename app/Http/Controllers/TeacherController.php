<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function loginAdminform(){
        return view('admin.login');
    }

    public function login(Request $request){
        //dd($request->all());
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password'] ])) {
            return redirect()->route('admin_dashboard')->with('error', 'Teacher Login is a success.');
        }else{
            return back()->with('error', 'Invalid credentials');
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function logoutAdmin(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error', 'Teacher Logout is a success.');
    }
}
