<?php

use Inertia\Inertia;
use App\Http\Middleware\UserRedirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;


//frontend route start
//home page
Route::get('/',[FrontHomeController::class,'index'])->name('home');
Route::get('/product/single/{id}',[FrontHomeController::class,'productSingle'])->name('product.single');

//cart
Route::post('/add-to-cart/{id}',[CartController::class,'addToCart'])->name('add.to.cart');

//category wise product
Route::get('/category-product/{id}',[FrontHomeController::class,'categoryWiseProduct'])->name('cateWiseProduct');

//brand wise product
Route::get('/brand-wise-product/{id}',[FrontHomeController::class,'brandWiseProduct'])->name('brand-wise-product');

//cart product
Route::get('/cart-product-view',[FrontHomeController::class,'cartProduct'])->name('view.cart');
Route::post('/increase-product-quantity/{id}',[FrontHomeController::class,'cartProductQuantityIncrease']);
Route::post('/decrease-product-quantity/{id}',[FrontHomeController::class,'cartProductQuantityDecrease']);
Route::get('/delete-cart-single-product/{id}',[FrontHomeController::class,'cartSingleProductDelete']);
Route::get('/clear-cart',[FrontHomeController::class,'clearCart']);

//checkout page
Route::get('/checkout',[CheckoutController::class,'checkout'])->middleware('user');
Route::post('/place-order',[CheckoutController::class,'placeOrder'])->middleware('user');
//frontend route end

//authentication  route for admin and user
 Route::get('/login',[UserAuthController::class,'loginForm'])->name('user.login');
 Route::get('/register',[UserAuthController::class,'registerForm'])->name('user.register');
 Route::post('user-login',[UserAuthController::class,'postLogin'])->name('user.post.login');
 Route::post('user-registration',[UserAuthController::class,'postRegistration'])->name('user.post.registration');

//user route
Route::middleware(['user'])->group(function(){
    Route::get('/user/dashboard',[UserAuthController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/user/logout',[UserAuthController::class,'userLogout'])->name('user.logout');
});


//admin route
Route::prefix('admin')->middleware(['admin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/logout',[AdminController::class,'logout'])->name('logout');


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
