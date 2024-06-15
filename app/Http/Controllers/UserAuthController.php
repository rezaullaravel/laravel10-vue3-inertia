<?php

namespace App\Http\Controllers;

use App\Models\User;

use Inertia\Inertia;
use inrtia\ResponseFactor;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
            //return view('auth.login');
        }

    }//end method


    //user registration form
    public function registerForm(){
        return inertia::render('Auth/Register');
    }//end method


    //user post registration
    public function postRegistration(Request $request){
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('message','Your registration has been completed successfully. Now you can login from');
    }//end method

    //post login
    public function postLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            $request->session()->regenerate();

            if (session()->has('previous_url')) {
                $previousUrl = $request->session()->pull('previous_url'); // Retrieve and remove the URL
                return redirect($previousUrl);

            }

            if(Auth::user()->role=='1'){
                 //return redirect()->route('admin.dashboard');
                 return Inertia::location('/admin/dashboard');


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
