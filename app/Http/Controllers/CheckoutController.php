<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //checkout page
    public function checkout(Request $request){
          if(Auth::check()){
            //cart products
            $cart_products = DB::table('carts')
            ->where('user_id',Auth::user()->id)
            ->join('products','carts.product_id','=','products.id')
            ->join('brands','products.brand_id','=','brands.id')
            ->orderBy('id','desc')
            ->select('carts.*', 'products.product_name','products.thumbnail', 'brands.brand_name')
            ->get();

            $categories = Category::limit(20)->get();
            $brands = Brand::limit(20)->get();

            //for checkout

            $customer = User::find(Auth::user()->id);
            return Inertia::render('Frontend/Checkout/Index',compact('customer','cart_products','categories','brands'));
          } else{
            return redirect('/login');
          }
    }//end method


    //place order
    public function placeOrder(Request $request){
        //cart products
        $cart_products = Cart::where('user_id',Auth::user()->id)->get();
        if(count($cart_products)>0){
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->customer_name = $request->customer_name;
        $order->customer_phone = $request->customer_phone;
        $order->customer_email = $request->customer_email;
        $order->shipping_address = $request->shipping_address;
        $order->subtotal = $request->subtotal;
        $order->total = $request->total;
        $order->payment_type = $request->payment_type;
        $order->status = 0;
        $order->save();


        foreach($cart_products as $product){
            OrderDetail::insert([
                'order_id'=> $order->id,
                'product_id'=>$product->product_id,
                'product_quantity'=>$product->quantity,
                'price'=>$product->price,
            ]);
        }

        //remove cart item
        Cart::where('user_id',Auth::user()->id)->delete();


        return redirect()->back();
        } else{
            return redirect()->back()->withErrors([
                'status'=>false,
            ]);
        }

    }//end method





}//end class
