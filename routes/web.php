<?php
//use App\Mail\HelloMail;
//use App\Http\Livewire\UserProduct;
// use App\Http\Livewire\LoginUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\ProductSpecificationController;
use App\Http\Controllers\VotedProductsController;

Route::get('/', function () {
    return view('user.index');
})->name('user.index');

//This right here is for the admin side
//admin logging
Route::get('admin', [AdminController::class, 'showForm'])->name('admin.login');
Route::get('admin/test', [AdminController::class, 'test'])->name('admin.test');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('admin/login', [AdminController::class,'login' ]);
Route::get('admin/logout', [AdminController::class,'logout' ])->name('admin.logout');

// Route::get('/testroute', function() {
//     Mail::to('christianpaulespares1@gmail.com')->send(new HelloMail());
// });

//Admin Dashboard
Route::get('admin/dashboard', [AdminController::class, 'showdashboard'])->name('admin.dashboard');

//Product Side
//admin side
//products side check
Route::get('admin/product', [ProductController::class, 'showProducts'])->name('admin.product');
Route::post('admin/product', [ProductController::class, 'addProduct'])->name('admin.product.add');
Route::get('admin/product/edit/{product}', [ProductController::class, 'editProduct'])->name('admin.product.edit');
Route::put('admin/product/edit/{product}', [ProductController::class, 'updateProduct'])->name('admin.product.update');
// Route::put('admin/product/update/{product}', [ProductController::class,'updateProductAjax'])->name('admin.product.update.ajax');
Route::delete('admin/product/delete/{product}', [ProductController::class, 'deleteProduct'])->name('admin.product.delete');

//Product Specification Side
Route::get('admin/product/specification', [ProductSpecificationController::class, 'showProductSpecification'])->name('admin.product.specification');
Route::post('admin/product/specification', [ProductSpecificationController::class, 'addProductSpecification'])->name('admin.product.specification.add');
Route::get('admin/product/specification/edit/{product}', [ProductSpecificationController::class, 'editProductSpecification'])->name('admin.product.specification.edit');
Route::put('admin/product/specification/edit/{product}', [ProductSpecificationController::class, 'updateProductSpecification'])->name('admin.product.specification.update');
Route::delete('admin/product/specification/delete/{product}', [ProductSpecificationController::class, 'deleteProductSpecification'])->name('admin.product.specification.delete');

//Product Inventory Side
Route::get('admin/product/inventory', [InventoryController::class, 'showProductInventory'])->name('admin.product.inventory');
Route::post('admin/product/inventory', [InventoryController::class, 'addProductInventory'])->name('admin.product.inventory.add');
Route::get('admin/product/inventory/edit/{product}', [InventoryController::class, 'editProductInventory'])->name('admin.product.inventory.edit');
Route::put('admin/product/inventory/edit/{product}', [InventoryController::class, 'updateProductInventory'])->name('admin.product.inventory.update');
Route::delete('admin/product/inventory/delete/{product}', [InventoryController::class, 'deleteProductInventory'])->name('admin.product.inventory.delete');


//category side check
Route::get('admin/category', [CategoryController::class, 'showCategories'])->name('admin.category');
Route::post('admin/category', [CategoryController::class, 'addCategory'])->name('admin.category.add');
Route::get('admin/category/edit/{category}', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
Route::put('admin/category/edit/{category}', [CategoryController::class, 'updateCategory'])->name('admin.category.update');
Route::delete('admin/category/delete/{category}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');



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
Route::post('admin/blog',[BlogController::class,'addBlog'])->name('admin.blog.add');
Route::get('admin/blog/edit/{blog}',[BlogController::class,'editBlog'])->name('admin.blog.edit');
Route::put('admin/blog/update/{blog}',[BlogController::class,'updateBlog'])->name('admin.blog.update');
Route::delete('admin/blog/delete/{blog}',[BlogController::class,'deleteBlog'])->name('admin.blog.delete');



//Product side
Route::get('admin/product', [ProductController::class, 'showProducts'])->name('admin.product');





// Route::post('user/login', [UserController::class,'login' ])->name('user.login.submit');
//This is the user side
//user logging
Route::get('user/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('user/logout', [UserController::class,'logout' ])->name('user.logout');

//user registering
Route::get('user/register', [UserController::class, 'showRegisterForm'])->name('user.register');
Route::post('user/register', [UserController::class, 'register'])->name('user.register.submit');

Route::get('user/consumer', [HomeController::class, 'showCondashboard'])->name('user.consumer');
Route::get('user/consumer/contacts', [HomeController::class, 'showConContact'])->name('user.consumer.contact');
Route::get('user/consumer/about-us', [HomeController::class, 'showConAbout'])->name('user.consumer.about');


Route::get('user/farmer/contacts', [HomeController::class, 'showFarmContact'])->name('user.farmer.contact');
Route::get('user/farmer/about-us', [HomeController::class, 'showFarmAbout'])->name('user.farmer.about');


Route::middleware(['user.type:1'])->group(function () {


Route::get('user/consumer/profile', [UserController::class, 'showUserprofile'])->name('user.consumer.profile.show');
Route::get('user/consumer/blogs', [BlogController::class, 'showConsumerBlogs'])->name('user.consumer.blog');


Route::get('user/consumer/orders', function () {
    return view('user.order.show');
});

});
Route::middleware(['user.type:2'])->group(function () {



Route::get('user/farmer', [HomeController::class, 'showFarmDashboard'])->name('user.farmer');
Route::get('/user/farmer/profile', [UserController::class, 'showFarmerprofile'])->name('user.farmer.profile');
Route::get('user/farmer/blogs', [BlogController::class, 'showFarmerBlogs'])->name('user.farmer.blog');



});

//Dashboard for Users

//Shipping Address for Consumer

Route::get('user/farmer/profile', [UserController::class, 'showFarmerprofile'])->name('user.farmer.profile');
Route::get('user/farmer/profile/edit', [UserController::class, 'editFarmerprofile'])->name('user.farmer.profile.edit');
Route::put('user/farmer/profile/update', [UserController::class, 'updateFarmerprofile'])->name('user.farmer.profile.update');

//Product for Consumers
Route::get('user/consumer/products', [UserProductController::class, 'showConsumerProduct'])->name('user.consumer.product');
Route::get('user/consumer/product/view/{product}', [UserProductController::class, 'viewConsumerProduct'])->name('user.consumer.product.view');


//cart for Consumers
Route::get('user/consumer/cart', [CartController::class, 'showConsumerCart'])->name('user.consumer.product.cart');
Route::get('user/consumer/cart/checkout/{cart}', [CartController::class, 'showConsumerCheckout'])->name('user.consumer.product.cart.checkout');

Route::get('user/consumer/favorites', [FavoriteController::class, 'showConsumerFavorites'])->name('user.consumer.favorites');

Route::get('user/consumer/chat', [ChatController::class, 'showConsumerChat'])->name('user.consumer.chat');

Route::get('user/consumer/voting', [VotedProductsController::class, 'showConsumerVoting'])->name('user.consumer.voting');


//Product for Farmers
Route::get('user/farmer/product', [UserController::class, 'showFarmerProduct'])->name('user.farmer.product');
Route::get('user/farmer/product/view/{id}', [UserController::class, 'viewFarmerProduct'])->name('user.farmer.product.view');


//Order Side
//user side




//user side

//blog Side


//user side

//report Side


//customization Side

//message Side
//admin side

//user side
