<?php

namespace App\Http\Controllers;

use App\Models\User;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Category;
use inrtia\ResponseFactor;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;
use Illuminate\Support\Facades\DB;
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
            $categories = Category::all();
            $brands = Brand::all();
            return inertia::render('Auth/Login',compact('categories','brands'));
            //return view('auth.login');
        }

    }//end method


    //user registration form
    public function registerForm(){
        $categories = Category::all();
        $brands = Brand::all();
        return inertia::render('Auth/Register',compact('categories','brands'));
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
        if(Auth::check()){
            $cart_products = DB::table('carts')
            ->where('user_id',Auth::user()->id)
            ->join('products','carts.product_id','=','products.id')
            ->join('brands','products.brand_id','=','brands.id')
            ->orderBy('id','desc')
            ->select('carts.*', 'products.product_name','products.thumbnail', 'brands.brand_name')
            ->get();
        } else {
            $cart_products = [];
      }
      $categories = Category::limit(20)->get();
        $brands = Brand::limit(20)->get();
       return Inertia::render('User/Dashboard',compact('cart_products','categories','brands'));
    }//end method


    //user logout
    public function userLogout(){
        Auth::logout();
        return redirect('/');
    }//end method
}
