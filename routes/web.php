<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//home page
Route::get('/',[FrontHomeController::class,'index'])->middleware('inertia.root:app2');


//authentication  route for admin and user
Route::get('/login',[UserAuthController::class,'loginForm'])->name('admin.login')->middleware('inertia.root:app');
Route::post('/user-login',[UserAuthController::class,'postLogin'])->middleware('inertia.root:app');

//user route
Route::middleware(['user'])->group(function(){
    Route::get('/user/dashboard',[UserAuthController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/user/logout',[UserAuthController::class,'userLogout'])->name('user.logout');
});


//admin route
Route::middleware(['admin','inertia.root:app'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::post('/logout',[AdminController::class,'logout'])->name('logout');


    //category route
    Route::get('/category/list',[CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/store/category',[CategoryController::class,'store'])->name('category.store');
    Route::get('/edit/category/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/update/category/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::get('/delete/category/{id}',[CategoryController::class,'delete'])->name('category.delete');


    //brand
    Route::get('/brand/list',[BrandController::class,'index'])->name('brand.index');
    Route::get('/brand/create',[BrandController::class,'create'])->name('brand.create');
    Route::post('/store/brand',[BrandController::class,'store'])->name('brand.store');
    Route::get('/edit/brand/{id}',[BrandController::class,'edit'])->name('brand.edit');
    Route::post('/update/brand/{id}',[BrandController::class,'update'])->name('brand.update');
    Route::get('/delete/brand/{id}',[BrandController::class,'delete'])->name('brand.delete');


    //product
    Route::get('/product/list',[ProductController::class,'index'])->name('product.index');
    Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/store/product',[ProductController::class,'store'])->name('product.store');
    Route::get('/view/product/{id}',[ProductController::class,'view'])->name('product.view');
    Route::get('/edit/product/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::get('/delete/image/{id}',[ProductController::class,'deleteImage'])->name('delete.image');
    Route::post('/update/product/{id}',[ProductController::class,'update'])->name('product.update');
    Route::get('/delete/product/{id}',[ProductController::class,'delete'])->name('product.delete');
});
