<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    //home page
    public function index(){
        $categories = Category::limit(20)->get();
        $new_products = Product::with('category','brand','MultiImages')->orderBy('id','desc')->limit(8)->get();

        return inertia::render('Frontend/HomeIndex',compact('new_products','categories'));
    }//end method


    //product single page
    public function productSingle($id){
        $product = Product::with('MultiImages')->find($id);
        $categories = Category::limit(20)->get();
        return inertia::render('Frontend/Product/ProductSingle',compact('product','categories'));
    }//end method


    //category wise product
    public function categoryWiseProduct($id){
        $products = Product::where('category_id',$id)->with('category')->orderBy('id','desc')->limit(20)->get();
        $category = Category::find($id);
        $categories = Category::limit(20)->get();
        return inertia::render('Frontend/Product/CategoryProduct',compact('products','category','categories'));
    }//end method
}//end method
