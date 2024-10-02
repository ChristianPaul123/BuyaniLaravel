<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

Route::get('/', function () {
    return view('user.index');
});

//admin logging
Route::get('/admin', [AdminController::class, 'showForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class,'login' ]);
Route::get('admin/logout', [AdminController::class,'logout' ])->name('admin.logout');

Route::get('admin/dashboard', [AdminController::class, 'showdashboard'])->name('admin.dashboard');

//user logging
Route::get('user/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('user/login', [UserController::class,'login' ])->name('user.login.submit');
Route::post('user/logout', [UserController::class,'logout' ])->name('user.logout');

//user registering
Route::get('user/register', [UserController::class, 'showRegisterForm'])->name('user.register');
Route::post('user/register', [UserController::class, 'register'])->name('user.register.submit');

Route::get('user/consumer', [UserController::class, 'showCondashboard'])->name('user.consumer');
Route::get('user/farmer', [UserController::class, 'showFarmDashboard'])->name('user.farmer');


//Product Side
//admin side
 Route::get('admin/product', [ProductController::class, 'showProducts'])->name('admin.product');

 Route::get('admin/order', function () {
    return view('admin.order');
});

Route::get('admin/customization', function () {
    return view('admin.customization');
});

Route::get('admin/report', function () {
    return view('admin.report');
});

Route::get('admin/message', function () {
    return view('admin.messenger');
});

Route::get('admin/subcategory', function () {
    return view('admin.subcategory');
});

Route::get('admin/category', function () {
    return view('admin.category');
});

Route::get('admin/blog', function () {
    return view('admin.blog');
});
 //user side
// Route::get('user/farmer', [UserController::class, 'showFarmDashboard'])->name('user.farmer');
// Route::get('user/consumer', [UserController::class, 'showCondashboard'])->name('user.consumer');
// Route::get('user/farmer', [UserController::class, 'showFarmDashboard'])->name('user.farmer');
// Route::get('user/consumer', [UserController::class, 'showCondashboard'])->name('user.consumer');
// Route::get('user/farmer', [UserController::class, 'showFarmDashboard'])->name('user.farmer');


//Order Side
//admin side

//user side

//Category Side
//admin side

//user side

//SubCategory Side
//admin side

//user side

//blog Side
//admin side

//user side

//report Side


//customization Side

//message Side
//admin side

//user side
