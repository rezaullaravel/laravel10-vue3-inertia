<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    //home page
    public function index(){

        return inertia::render('Frontend/Master');
        //return view('example');
    }//end method
}//end method
