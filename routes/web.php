<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('user.index');
});

//admin logging
Route::get('/admin', [AdminController::class, 'showForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class,'login' ]);
Route::post('admin/logout', [AdminController::class,'logout' ])->name('admin.logout');

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

// Route::get('admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware('auth:admin')->name('admin.dashboard');


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
