<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //add to cart
    public function addToCart(Request $request,$id){
        if(Auth::check()){
            $cartProduct = Cart::where('user_id',Auth::user()->id)->where('product_id',$id)->first();

            $product = Product::find($id);
             if($cartProduct){
                 return redirect()->back()->withErrors([
                 'message'=>'Product exists already',
                 ]);
             } else{
                 $cart = new Cart;
                 $cart->user_id = Auth::user()->id;
                 $cart->product_id = $id;
                 if($request->quantity){
                     $cart->quantity= $request->quantity;
                 }
                 $cart->price = $product->price;
                 $cart->save();
                 return redirect()->back()->withSuccess(['message'=>'add successfully']);
             }


        } else{
            $previous_url =  Session::put('previous_url',url()->previous());
           return inertia::location('/login');

        }

    }//end method
}
