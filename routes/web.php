<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserProductController;

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
//products side check
Route::get('admin/product', [ProductController::class, 'showProducts'])->name('admin.product');
Route::post('admin/product', [ProductController::class, 'addProduct'])->name('admin.product.add');
Route::get('admin/product/edit/{product}', [ProductController::class, 'editProduct'])->name('admin.product.edit');
Route::put('admin/product/edit/{product}', [ProductController::class, 'updateProduct'])->name('admin.product.update');
Route::delete('admin/product/delete/{product}', [ProductController::class, 'deleteProduct'])->name('admin.product.delete');

//category side check
Route::get('admin/category', [CategoryController::class, 'showCategories'])->name('admin.category');
Route::post('admin/category', [CategoryController::class, 'addCategory'])->name('admin.category.add');
Route::get('admin/category/edit/{category}', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
Route::put('admin/category/edit/{category}', [CategoryController::class, 'updateCategory'])->name('admin.category.update');
Route::delete('admin/category/delete/{category}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');

//subcategory side check
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


//Blog side
Route::get('admin/blog', function () {
    return view('admin.blog.blog_post');
});

Route::get('admin/blog',[BlogController::class,'showBlogs'])->name('admin.blog');
Route::post('admin/blog/add',[BlogController::class,'addBlog'])->name('admin.blog.add');
Route::get('admin/blog/edit/{blog}',[BlogController::class,'editBlog'])->name('admin.blog.edit');
Route::put('admin/blog/update/{blog}',[BlogController::class,'updateBlog'])->name('admin.blog.update');
Route::delete('admin/blog/delete/{blog}',[BlogController::class,'deleteBlog'])->name('admin.blog.delete');



//Product side
Route::get('admin/product', [ProductController::class, 'showProducts'])->name('admin.product');



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
Route::get('user/consumer/contacts', [UserController::class, 'showConContact'])->name('user.consumer.contact');
Route::get('user/consumer/about-us', [UserController::class, 'showAbout'])->name('user.consumer.about');
Route::get('user/farmer', [UserController::class, 'showFarmDashboard'])->name('user.farmer');


//Product for Consumers
Route::get('user/consumer/products', [UserProductController::class, 'showConsumerProduct'])->name('user.consumer.product');
Route::get('user/consumer/product/view/{id}', [UserProductController::class, 'viewConsumerProduct'])->name('user.consumer.product.view');
Route::post('user/consumer/product/add', [UserProductController::class, 'addConsumerProduct'])->name('user.consumer.product.add');

//cart for Consumers
Route::get('user/consumer/product/cart', [CartController::class, 'showConsumerCart'])->name('user.consumer.product.cart');
Route::get('user/consumer/product/cart/delete/{id}', [CartController::class, 'deleteConsumerCart'])->name('user.consumer.product.cart.delete');
Route::get('user/consumer/product/cart/checkout', [CartController::class, 'showConsumerCheckout'])->name('user.consumer.product.cart.checkout');
Route::post('user/consumer/product/cart/checkout', [CartController::class, 'checkoutConsumerCart'])->name('user.consumer.product.cart.checkout.submit');
Route::get('user/consumer/product/cart/checkout/success', [CartController::class, 'showConsumerCheckoutSuccess'])->name('user.consumer.product.cart.checkout.success');

//Product for Farmers
Route::get('user/farmer/product', [UserController::class, 'showFarmerProduct'])->name('user.farmer.product');
Route::get('user/farmer/product/view/{id}', [UserController::class, 'viewFarmerProduct'])->name('user.farmer.product.view');


//Order Side
Route::get('user/consumer/orders', function () {
    return view('user.order.show');
});

Route::get('user/consumer/cart', function () {
    return view('user.cart.show');
});

Route::get('user/consumer/user-profile', function () {
    return view('user.order.show');
});

Route::get('user/consumer/orders', function () {
    return view('user.order.show');
});


//user side




//user side

//blog Side


//user side

//report Side


//customization Side

//message Side
//admin side

//user side
