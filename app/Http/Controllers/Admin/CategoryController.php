<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //all category
    public function index(){
        $categories = Category::orderBy('id','desc')->paginate(2);
        return Inertia::render('Admin/Category/Index',compact('categories'));
    }//end method


    //category create form
    public function create(){
        return Inertia::render('Admin/Category/Create');
    }//end method


    //category store
    public function store(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->route('category.index')->with('message','Category created successfully.');
    }//end method
}
