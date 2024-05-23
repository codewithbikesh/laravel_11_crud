<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\ProductController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/products',[ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/products',[ProductController::class,'store'])->name('products.store');
Route::get('/products/{product}/edit',[ProductController::class,'edit'])->name('products.edit');
Route::put('/products/{product}',[ProductController::class,'update'])->name('products.update');
Route::delete('/products/{product}',[ProductController::class,'destroy'])->name('products.destroy');

// For Login page 
Route::group(['prefix' => 'account'], function () {

// Guest Middleware 
Route::group(['middleware' => 'guest'], function () {
Route::get('login',[LoginController::class,'login'])->name('account.login');
Route::post('authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
Route::get('register',[LoginController::class,'register'])->name('account.register');
Route::post('process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
});

// Auth Middleware 
Route::group(['middleware' => 'auth'], function () {
Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('account.dashboard');
});

});

// For admin login page 
Route::group(['prefix'=> 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        // Admin Authentication Route 
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
    });
         //Admin Auth Middleware Route
    Route::group(['middleware' =>  'admin.auth'], function () {
        Route::get('dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');        
    });

});



