<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    //admin/user login form
    public function loginForm(){
        if(Auth::check()){
            if(Auth::user()->role=='1'){
                return redirect()->route('admin.dashboard');
            } else{
                return redirect()->route('user.dashboard');
            }
        }else{
            return inertia::render('Auth/Login');
        }

    }//end method

    //post login
    public function postLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {


            if(Auth::user()->role=='1'){
                return redirect()->route('admin.dashboard');
            } else{
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'message' => 'Oops! This credentials do not match our records.',
        ]);
    }//end method


    //user dashboard
    public function userDashboard(){
       return Inertia::render('User/Dashboard');
    }//end method

    
    //user logout
    public function userLogout(){
        Auth::logout();
        return redirect('/');
    }//end method
}
