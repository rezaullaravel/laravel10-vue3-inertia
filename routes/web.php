<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/', function () {
    return inertia::render('Index');
});


//authentication  route for admin and user
Route::get('/login',[UserAuthController::class,'loginForm'])->name('admin.login');
Route::post('/user-login',[UserAuthController::class,'postLogin']);

//user route
Route::middleware(['user'])->group(function(){
    Route::get('/user/dashboard',[UserAuthController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/user/logout',[UserAuthController::class,'userLogout'])->name('user.logout');
});


//admin route
Route::middleware(['admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/logout',[AdminController::class,'logout'])->name('logout');


    //category route
    Route::get('/category/list',[CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/store/category',[CategoryController::class,'store'])->name('category.store');
});
