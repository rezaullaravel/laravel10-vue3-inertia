<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
     //product list
     public function index(){
        $products = Product::with(['category','brand'])->orderBy('id','desc')->paginate(2);
        //return response()->json($products);
        return Inertia::render('Admin/Product/Index',compact('products'));
    }//end method


    //product create
    public function create(){
        $categories = Category::all();
        $brands = Brand::all();
        return Inertia::render('Admin/Product/Create',compact('categories','brands'));
    }//end method


    //product store
    public function store(Request $request){
        $request->validate([
            'product_name'=>'required',
             'images'=>'required',
             'thumbnail'=>'required|image',
              'price'=>'required',
              'category_id'=>'required',
              'brand_id'=>'required',
              'description'=>'required',
        ],[
            'category_id.required'=>'The category field is required.',
            'brand_id.required'=>'The brand field is required.',
            'images.required'=>'The multiple image field is required.'
        ]);

        //product thumbnail  upload
        if($request->file('thumbnail')){
            $image = $request->file('thumbnail');
            $imageName = rand().'.'.$image->getClientOriginalName();
            $image->move('upload/product_thumbnail/',$imageName);
        }

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->thumbnail = $imageName;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        //product multiple image upload
        if($request->file('images')){
            $multiImages = $request->file('images');
            foreach($multiImages as $photo){
                $photoName = rand().'.'.$photo->getClientOriginalName();
                $photo->move('upload/product_multi_images/',$photoName);
                $model = new MultiImg;
                $model->product_id = $product->id;
                $model->image = $photoName;
                $model->save();
            }
        }


        return redirect()->route('product.index')->with('message','Product created successfully.');
    }//end method


    //view product details
    public function view($id){
        $product = Product::with('category','brand','MultiImages')->find($id);

        return Inertia::render('Admin/Product/View',compact('product'));
    }//end method


    //edit product
    public function edit($id){
        $product = Product::with('category','brand','MultiImages')->find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return Inertia::render('Admin/Product/Edit',compact('product','categories','brands'));
    }//end method


    //delete image from multi image table
    public function deleteImage($id){
        $model = MultiImg::find($id);
        if(File::exists('upload/product_multi_images/'.$model->image)){
            unlink('upload/product_multi_images/'.$model->image);
        }
        $model->delete();
        return back();
    }//end method


    //product update
    public function update(Request $request,$id){

        $request->validate([
            'product_name'=>'required',
              'price'=>'required',
              'category_id'=>'required',
              'brand_id'=>'required',
              'description'=>'required',
        ],[
            'category_id.required'=>'The category field is required.',
            'brand_id.required'=>'The brand field is required.',
        ]);

        $product = Product::find($id);
        //product thumbnail  upload
        if($request->file('thumbnail')){
            if(File::exists('upload/product_thumbnail/'.$product->thumbnail)){
                unlink('upload/product_thumbnail/'.$product->thumbnail);
            }
            $image = $request->file('thumbnail');
            $imageName = rand().'.'.$image->getClientOriginalName();
            $image->move('upload/product_thumbnail/',$imageName);
            $product->thumbnail =  $imageName;
        }

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        //product multiple image upload
        if($request->file('images')){
            $multiImages = $request->file('images');
            foreach($multiImages as $photo){
                $photoName = rand().'.'.$photo->getClientOriginalName();
                $photo->move('upload/product_multi_images/',$photoName);
                $model = new MultiImg;
                $model->product_id = $product->id;
                $model->image = $photoName;
                $model->save();
            }
        }


        return redirect()->route('product.index')->with('message','Product updated successfully.');
    }//end method


    //product delete
    public function delete($id){
        $product = Product::with('MultiImages')->find($id);
        //product thumbnail  delete
            if(File::exists('upload/product_thumbnail/'.$product->thumbnail)){
                unlink('upload/product_thumbnail/'.$product->thumbnail);
            }

            //product multiple image delete
            foreach($product->MultiImages as $image){
                if(File::exists('upload/product_multi_images/'.$image->image)){
                    unlink('upload/product_multi_images/'.$image->image);
                }
                $model = MultiImg::find($image->id);
                $model->delete();
            }

            $product->delete();
            return redirect()->route('product.index')->with('message','Product deleted successfully.');

    }//end method



}//end method
