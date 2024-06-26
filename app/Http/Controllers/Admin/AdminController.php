<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    //admin dashboard
    public function index(){
        return inertia::render('Admin/Home');
    }//end method

    //admin logout
    public function logout(Request $request){

        Auth::logout();
        //return redirect('/');
       return Inertia::location('/');
    }//end method

}
