<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    //brand list
    public function index(){
        $brands = Brand::orderBy('id','desc')->paginate(2);
        return Inertia::render('Admin/Brand/Index',compact('brands'));
    }//end method


    //brand create
    public function create(){
        return Inertia::render('Admin/Brand/Create');
    }//end method


    //brand store
    public function store(Request $request){
        $request->validate([
            'brand_name'=>'required|unique:brands',
             'image'=>'required|image'
        ]);

        //image upload
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = rand().'.'.$image->getClientOriginalName();
            $image->move('upload/brand_images/',$imageName);
        }

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->image = $imageName;
        $brand->save();
        return redirect()->route('brand.index')->with('message','Brand created successfully.');
    }//end method


     //brand edit form
     public function edit($id){
        $brand = Brand::find($id);
        return Inertia::render('Admin/Brand/Edit',compact('brand'));
    }//end method


    //brand update
    public function update(Request $request,$id){
        $request->validate([
            'brand_name'=>'required|unique:brands,brand_name,'.$id,
             'image'=>'nullable'
        ]);

        $brand = Brand::find($id);
        //image upload
        if($request->file('image')){
            if(File::exists('upload/brand_images/'.$brand->image)){
                unlink('upload/brand_images/'.$brand->image);
            }

            $image = $request->file('image');
            $imageName = rand().'.'.$image->getClientOriginalName();
            $image->move('upload/brand_images/',$imageName);
            $brand->image = $imageName;
        }


        $brand->brand_name = $request->brand_name;
        $brand->save();
        return redirect()->route('brand.index')->with('message','Brand updated successfully.');
    }//end method


    //brand delete
    public function delete($id){
        $brand = Brand::find($id);
        if(File::exists('upload/brand_images/'.$brand->image)){
            unlink('upload/brand_images/'.$brand->image);
        }
        $brand->delete();
        return redirect()->route('brand.index')->with('message','Brand deleted successfully.');
    }//end method
}//end class
