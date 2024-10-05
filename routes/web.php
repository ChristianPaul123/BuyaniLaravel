<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SubCategoryController;

Route::get('/', function () {
    return view('user.index');
});


//This right here is for the admin side
//admin logging
Route::get('/admin', [AdminController::class, 'showForm'])->name('admin.login');
Route::get('/admin/test', [AdminController::class, 'test'])->name('admin.test');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('admin/login', [AdminController::class,'login' ]);
Route::get('admin/logout', [AdminController::class,'logout' ])->name('admin.logout');

//Admin Dashboard
Route::get('admin/dashboard', [AdminController::class, 'showdashboard'])->name('admin.dashboard');

//Product Side
//admin side
//products side
Route::get('admin/product', [ProductController::class, 'showProducts'])->name('admin.product');
Route::get('admin/product/add', [ProductController::class, 'showAddProduct'])->name('admin.product.create');
Route::post('admin/product/add', [ProductController::class, 'addProduct'])->name('admin.product.add');
Route::get('admin/product/edit/{product}', [ProductController::class, 'editProduct'])->name('admin.product.edit');
Route::put('admin/product/edit/{product}', [ProductController::class, 'updateProduct'])->name('admin.product.update');
Route::delete('admin/product/delete/{product}', [ProductController::class, 'deleteProduct'])->name('admin.product.delete');

//category side check
Route::get('admin/category', [CategoryController::class, 'showCategories'])->name('admin.category');
Route::post('admin/category', [CategoryController::class, 'addCategory'])->name('admin.category.add');
Route::get('admin/category/edit/{category}', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
Route::put('admin/category/edit/{category}', [CategoryController::class, 'updateCategory'])->name('admin.category.update');
Route::delete('admin/category/delete/{category}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');

//subcategory side
Route::get('admin/subcategory', [SubCategoryController::class, 'showSubCategories'])->name('admin.subcategory');
Route::post('admin/subcategory/add', [SubCategoryController::class, 'addSubCategory'])->name('admin.subcategory.add');
Route::get('admin/subcategory/edit/{subcategory}', [SubCategoryController::class, 'editSubCategory'])->name('admin.subcategory.edit');
Route::put('admin/subcategory/update/{subcategory}', [SubCategoryController::class, 'updateSubCategory'])->name('admin.subcategory.update');
Route::delete('admin/subcategory/delete/{subcategory}', [SubCategoryController::class, 'deleteSubCategory'])->name('admin.subcategory.delete');



//order Side
Route::get('admin/order', [OrderController::class,'showOrders'])->name('admin.order');
Route::get('admin/order/view/{id}', [OrderController::class,'viewOrder'])->name('admin.order.view');

Route::get('admin/customization', function () {
    return view('admin.management.customization');
});

Route::get('admin/report', function () {
    return view('admin.report.report');
});

Route::get('admin/message', function () {
    return view('admin.message.messenger');
});




Route::get('admin/blog', function () {
    return view('admin.blog.blog_post');
});

//This is the user side


//user logging
Route::get('user/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('user/login', [UserController::class,'login' ])->name('user.login.submit');
Route::post('user/logout', [UserController::class,'logout' ])->name('user.logout');

//user registering
Route::get('user/register', [UserController::class, 'showRegisterForm'])->name('user.register');
Route::post('user/register', [UserController::class, 'register'])->name('user.register.submit');

//Dashboard for Users
Route::get('user/consumer', [UserController::class, 'showCondashboard'])->name('user.consumer');
Route::get('user/farmer', [UserController::class, 'showFarmDashboard'])->name('user.farmer');



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
