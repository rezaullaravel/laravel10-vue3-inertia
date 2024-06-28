<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontHomeController extends Controller
{
    protected function productfromCart(){
        $cart_products = DB::table('carts')
            ->where('user_id',Auth::user()->id)
            ->join('products','carts.product_id','=','products.id')
            ->join('brands','products.brand_id','=','brands.id')
            ->orderBy('id','desc')
            ->select('carts.*', 'products.product_name','products.thumbnail', 'brands.brand_name')
            ->get();
            return $cart_products;
    }
    //home page
    public function index(){
        $categories = Category::limit(20)->get();
        $brands = Brand::limit(20)->get();
        $new_products = Product::with('category','brand','MultiImages')->orderBy('id','desc')->limit(8)->get();

        if(Auth::check()){
            $cart_products = $this->productfromCart();
        } else {
              $cart_products = [];
        }

        return inertia::render('Frontend/HomeIndex',compact('new_products','categories','brands','cart_products'));
    }//end method


    //product single page
    public function productSingle($id){
        $product = Product::with('MultiImages')->find($id);
        $categories = Category::limit(20)->get();
        $brands = Brand::limit(20)->get();

        if(Auth::check()){
            $cart_products = $this->productfromCart();
        } else {
              $cart_products = [];
        }
        return inertia::render('Frontend/Product/ProductSingle',compact('product','categories','brands','cart_products'));
    }//end method


    //category wise product
    public function categoryWiseProduct($id){
        $products = Product::where('category_id',$id)->with('category')->orderBy('id','desc')->limit(20)->get();
        $category = Category::find($id);
        $categories = Category::limit(20)->get();
        $brands = Brand::all();

        if(Auth::check()){
            $cart_products = $this->productfromCart();
        } else {
              $cart_products = [];
        }

        return inertia::render('Frontend/Product/CategoryProduct',compact('products','category','categories','brands','cart_products'));
    }//end method


    //brand wise product
    public function brandWiseProduct($id){
        $products = Product::where('brand_id',$id)->with('brand')->orderBy('id','desc')->limit(20)->get();
        $brand = Brand::find($id);
        $brands = Brand::all();
        $categories = Category::limit(20)->get();

        if(Auth::check()){
            $cart_products = $this->productfromCart();
        } else {
              $cart_products = [];
        }

        return inertia::render('Frontend/Product/BrandProduct',compact('products','brand','brands','categories','cart_products'));
    }//end method


    //cart product iew
    public function cartProduct(){
        if(Auth::check()){
        $cart_products = $this->productfromCart();
        $brands = Brand::all();
        $categories = Category::limit(20)->get();
        return inertia::render('Frontend/Product/CartProduct',compact('cart_products','brands','categories'));
        } else{
            $previous_url = '/cart-product-view';
            $previous_url =  Session::put('previous_url',$previous_url);
           return inertia::location('/login');
        }
    }//end method


    //increase cart product quantity
    public function cartProductQuantityIncrease($id){
        $cart_product = Cart::find($id);
        $cart_product->quantity = $cart_product->quantity+1;
        $cart_product->save();
        return redirect()->back();
    }//end method

     //deccrease cart product quantity
     public function cartProductQuantityDecrease($id){
        $cart_product = Cart::find($id);
        $cart_product->quantity = $cart_product->quantity-1;
        $cart_product->save();
        return redirect()->back();
    }//end method


    //delete cart single product
    public function cartSingleProductDelete($id){
        if(Auth::check()){
            Cart::find($id)->delete();
            return back();
        } else{
            return redirect('/login');
        }
    }

     //claer cart  product
     public function clearCart(){
        if(Auth::check()){
            Cart::where('user_id',Auth::user()->id)->delete();
            return back();
        } else{
            return redirect('/login');
        }
    }//end method
}//end method
