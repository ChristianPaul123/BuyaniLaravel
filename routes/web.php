<?php
//use App\Mail\HelloMail;
//use App\Http\Livewire\UserProduct;
// use App\Http\Livewire\LoginUser;
use App\Mail\testmail;
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
use App\Http\Controllers\SubCategoryController;



use App\Http\Controllers\UserProductController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\VotedProductsController;
use App\Http\Controllers\BlogManagementController;

use App\Http\Controllers\ChatManagementController;
use App\Http\Controllers\FarmerProduceController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\ReportManagementController;
use App\Http\Controllers\ReviewManagementController;
use App\Http\Controllers\ProductManagementController;
use App\Http\Controllers\InventoryManagementController;
use App\Http\Controllers\ProductSpecificationController;
use App\Http\Controllers\VotedProductsManagementController;
use App\Http\Controllers\SitemapController;

//fore creating the sitemap
Route::get('/generate-sitemap', [SitemapController::class, 'generate']);



// Route::get('/', function () {
//     return view('user.index');
// })->name('user.index');

Route::get('/', [HomeController::class, 'showCondashboard'])->name('user.consumer');

Route::get('/login', function () {
    return view('user.index');
})->name('user.index');


Route::get('/charge', [StripePaymentController::class, 'showForm']);

Route::post('/charge', [StripePaymentController::class, 'charge']);

//This right here is for the admin side

//ADMIN LOGGING
Route::get('admin', [AdminController::class, 'showForm'])->name('admin.login');
Route::get('admin/test', [AdminController::class, 'test'])->name('admin.test');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('admin/login', [AdminController::class,'login'])->name('admin.admin.login');
Route::get('admin/logout', [AdminController::class,'logout'])->name('admin.logout');


//Admin Dashboard
Route::get('admin/dashboard', [AdminController::class, 'showdashboard'])->name('admin.dashboard');

//CUSTOMIZATION - like settings for owner or something -_(-_-)_-
Route::post('admin/store', [AdminController::class, 'storenewAdmin'])->name('admin.store'); // Store New Admin
Route::get('admin/{admin}/edit', [AdminController::class, 'showeditAdmin'])->name('admin.edit'); // Edit Admin Page
Route::put('/admin/update/{admin}', [AdminController::class, 'updateAdmin'])->name('admin.update');
// Route::put('admin/{admin}/update', [AdminController::class, 'update'])->name('admin.update'); // Update Admin Info
Route::post('admin/{admin}/deactivate', [AdminController::class, 'deactivate'])->name('admin.deactivate');
Route::post('admin/{admin}/activate', [AdminController::class, 'activate'])->name('admin.activate');
Route::get('admin/customization', [AdminController::class, 'showCustomization'])->name('admin.customization');
Route::post('admin/payment/update', [AdminController::class, 'updateAdminPayment'])->name('admin.payment.update');
Route::get('admin/customization/sponsorimg', [AdminController::class, 'showSponsorimg'])->name('admin.customization.sponsor');
Route::post('admin/customization/sponsorimg/add', [AdminController::class, 'addSponsorimg'])->name('admin.customization.sponsor.add');
Route::get('admin/customization/sponsorimg/edit/{encryptedId}', [AdminController::class, 'editSponsorimg'])->name('admin.customization.sponsor.edit');
Route::post('admin/customization/sponsorimg/update/{id}', [AdminController::class, 'updateSponsorimg'])->name('admin.customization.sponsor.update');
Route::delete('admin/customization/sponsorimg/delete/{id}', [AdminController::class,'deleteSponsorimg'])->name('admin.customization.sponsor.delete');


//PRODUCT
Route::get('admin/product', [ProductManagementController::class, 'showProducts'])->name('admin.product.index');
Route::post('admin/product/add', [ProductManagementController::class, 'addProduct'])->name('admin.product.add');
Route::get('admin/product/edit/{encryptedId}', [ProductManagementController::class, 'editProduct'])->name('admin.product.edit');
Route::put('admin/product/update/{id}', [ProductManagementController::class, 'updateProduct'])->name('admin.product.update');
// Route::delete('admin/product/delete/{id}', [ProductManagementController::class, 'deleteProduct'])->name('admin.product.delete');
Route::post('admin/product/deactivate/{id}', [ProductManagementController::class, 'deactivateProduct'])->name('admin.product.deactivate');
Route::post('admin/product/activate/{id}', [ProductManagementController::class, 'activateProduct'])->name('admin.product.activate');


//PRODUCT - SPECIFICATION
Route::post('admin/product/specification/add', [ProductManagementController::class, 'addProductSpecification'])->name('admin.product.specification.add');
Route::get('admin/product/specification/edit/{encryptedId}', [ProductManagementController::class, 'editProductSpecification'])->name('admin.product.specification.edit');
Route::put('admin/product/specification/update/{id}', [ProductManagementController::class, 'updateProductSpecification'])->name('admin.product.specification.update');
// Route::delete('admin/product/specification/delete/{id}', [ProductManagementController::class, 'deleteProductSpecification'])->name('admin.product.specification.delete');
Route::post('admin/product/specification/deactivate/{id}', [ProductManagementController::class, 'deactivateProductSpecification'])->name('admin.product.specification.deactivate');
Route::post('admin/product/specification/activate/{id}', [ProductManagementController::class, 'activateProductSpecification'])->name('admin.product.specification.activate');


//PRODUCT - CATEGORY
Route::post('admin/category/add', [ProductManagementController::class, 'addCategory'])->name('admin.category.add');
Route::get('admin/category/edit/{encryptedId}', [ProductManagementController::class, 'editCategory'])->name('admin.category.edit');
//Route::get('admin/category/edit/{id}', [ProductManagementController::class, 'editCategory'])->name('admin.category.edit');
Route::put('admin/category/update/{id}', [ProductManagementController::class, 'updateCategory'])->name('admin.category.update');
// Route::delete('admin/category/delete/{id}', [ProductManagementController::class, 'deleteCategory'])->name('admin.category.delete');
Route::post('admin/category/deactivate/{id}', [ProductManagementController::class, 'deactivateCategory'])->name('admin.category.deactivate');
Route::post('admin/category/activate/{id}', [ProductManagementController::class, 'activateCategory'])->name('admin.category.activate');

//PRODUCT - SUBCATEGORY
Route::post('admin/subcategory/add', [ProductManagementController::class, 'addSubCategory'])->name('admin.subcategory.add');
Route::get('admin/subcategory/edit/{encryptedId}', [ProductManagementController::class, 'editSubCategory'])->name('admin.subcategory.edit');
Route::put('admin/subcategory/update/{id}', [ProductManagementController::class, 'updateSubCategory'])->name('admin.subcategory.update');
// Route::delete('admin/subcategory/delete/{id}', [ProductManagementController::class, 'deleteSubCategory'])->name('admin.subcategory.delete');
Route::post('admin/subcategory/deactivate/{id}', [ProductManagementController::class, 'deactivateSubCategory'])->name('admin.subcategory.deactivate');
Route::post('admin/subcategory/activate/{id}', [ProductManagementController::class, 'activateSubCategory'])->name('admin.subcategory.activate');

//PRODUCT INVENTORY
Route::get('admin/product/inventory', [InventoryManagementController::class, 'showProductInventory'])->name('admin.product.inventory');
Route::post('admin/product/inventory', [InventoryManagementController::class, 'addProductInventory'])->name('admin.product.inventory.add');
Route::get('admin/product/inventory/edit/{product}', [InventoryManagementController::class, 'editProductInventory'])->name('admin.product.inventory.edit');
Route::put('admin/product/inventory/edit/{product}', [InventoryManagementController::class, 'updateProductInventory'])->name('admin.product.inventory.update');


//ORDER
Route::get('admin/order', [OrderManagementController::class, 'showOrders'])->name('admin.orders.index');
Route::get('admin/orders/edit/{id}', [OrderManagementController::class, 'edit'])->name('admin.orders.edit');
Route::delete('admin/orders/delete/{id}', [OrderManagementController::class, 'destroy'])->name('admin.orders.delete');
Route::get('admin/orders/view/{id}', [OrderManagementController::class, 'viewOrder'])->name('admin.orders.view');
Route::get('admin/orders/cancel/{id}', [OrderManagementController::class, 'cancelOrder'])->name('admin.orders.reject');
Route::get('admin/orders/cancelled/{id}', [OrderManagementController::class, 'showCancelOrder'])->name('admin.orders.reject.view');
Route::post('admin/orders/ship', [OrderManagementController::class, 'shipOrderProcess'])->name('admin.orders.ship');
Route::post('admin/orders/cancelprocess/{id}', [OrderManagementController::class, 'cancelOrderProcess'])->name('admin.orders.processCancel');
Route::post('admin/orders/archive/{id}', [OrderManagementController::class, 'archiveOrder'])->name('admin.orders.archive');
Route::post('admin/orders/accept/{id}', [OrderManagementController::class, 'acceptOrder'])->name('admin.orders.accept');
// Route::get('admin/product/special', [OrderManagementController::class, 'showSpecial'])->name('admin.product.special');


Route::get('admin/orders/order-standby', [OrderManagementController::class, 'toStandby'])->name('admin.orders.to-standby');
Route::get('admin/orders/order-pay', [OrderManagementController::class, 'toPay'])->name('admin.orders.to-pay');
Route::get('admin/orders/order-ship', [OrderManagementController::class, 'toShip'])->name('admin.orders.to-ship');
Route::get('admin/orders/order-deliver', [OrderManagementController::class, 'toDeliver'])->name('admin.orders.to-deliver');
Route::get('admin/orders/order-completed', [OrderManagementController::class, 'completed'])->name('admin.orders.completed');
Route::get('admin/orders/order-cancelled', [OrderManagementController::class, 'cancelled'])->name('admin.orders.cancelled');


//REPORT
Route::get('admin/report/inventory', [ReportManagementController::class, 'showInventoryReports'])->name('admin.reports.inventory');
Route::get('admin/report/sales', [ReportManagementController::class, 'showSalesReports'])->name('admin.reports.sales');

//REPORT - LOGS
Route::get('admin/report/logs', [ReportManagementController::class, 'showLogsReports'])->name('admin.reports.logs');


//MANAGEMENT
Route::get('admin/user/management', [UserManagementController::class, 'showUsers'])->name('admin.management');
Route::get('admin/user/management/view/{id}', [UserManagementController::class, 'viewUser'])->name('admin.management.view');
Route::post('admin/user/management/deactivate/{id}', [UserManagementController::class, 'deactivateUser'])->name('admin.management.deactivate');
Route::post('admin/user/management/reactivate/{id}', [UserManagementController::class, 'reactivateUser'])->name('admin.management.reactivate');
Route::put('admin/user/management/farmer/form/{id}/verify', [UserManagementController::class, 'verifyForm'])->name('farmer.form.verify');
Route::put('admin/user/management/farmer/id/{id}/verify', [UserManagementController::class, 'verifyIdentification'])->name('farmer.id.verify');

//CHAT US
Route::get('admin/chat', [ChatManagementController::class, 'showAdminChat'])->name('admin.chat');

//


Route::get('admin/message', function () {
    return view('admin.message.messenger');
});




//REVIEWS
Route::get('admin/community/reviews', [ReviewManagementController::class, 'showReviews'])->name('admin.reviews');
Route::get('admin/community/reviews/orderrating/view/{id}', [ReviewManagementController::class, 'viewOrderReview'])->name('admin.reviews.view.orderrating');
Route::get('admin/community/reviews/productrating/view/{id}', [ReviewManagementController::class, 'viewProductReview'])->name('admin.reviews.view.productrating');
Route::post('admin/community/reviews/productrating/update/{id}', [ReviewManagementController::class, 'updateProductReview'])->name('admin.reviews.update.productrating');
Route::post('admin/community/reviews/orderrating/update/{id}', [ReviewManagementController::class, 'updateOrderReview'])->name('admin.reviews.update.orderrating');
// Route::post('admin/community/reviews/productrating/view/{id}', [ReviewManagementController::class, 'editReview'])->name('admin.reviews.edit');
// Route::post('admin/community/reviews/productrating/view/{id}', [ReviewManagementController::class, 'editReview'])->name('admin.reviews.edit');


Route::post('admin/community/reviews/orderrating/{id}/deactivate', [ReviewManagementController::class, 'orderRatingdeactivate'])->name('admin.reviews.orderrating.deactivate');
Route::post('admin/community/reviews/orderrating/{id}/activate', [ReviewManagementController::class, 'orderRatingactivate'])->name('admin.reviews.orderrating.activate');
Route::post('admin/community/reviews/productrating/{id}/deactivate', [ReviewManagementController::class, 'productRatingdeactivate'])->name('admin.reviews.productrating.deactivate');
Route::post('admin/community/reviews/productrating/{id}/activate', [ReviewManagementController::class, 'productRatingactivate'])->name('admin.reviews.productrating.activate');

//VOTED PRODUCTS

Route::get('admin/community/votes',[VotedProductsManagementController::class, 'showVotedProducts'])->name('admin.voted-products');
Route::get('admin/community/votes/suggestionss/{id}',[VotedProductsManagementController::class, 'viewSuggestproduct'])->name('admin.voted-products.suggestions.view');
Route::post('admin/community/votes/suggestions/{id}/accept', [VotedProductsManagementController::class, 'acceptSuggestproduct'])->name('admin.voted-products.suggestions.accept');
Route::post('admin/community/votes/suggestions/{id}/reject', [VotedProductsManagementController::class, 'rejectSuggestproduct'])->name('admin.voted-products.suggestions.reject');

//BLOGS
Route::get('admin/community/blog',[BlogManagementController::class,'showBlogs'])->name('admin.blog');
Route::post('admin/blog',[BlogManagementController::class,'addBlog'])->name('admin.blog.add');
Route::get('admin/blog/edit/{blog}',[BlogManagementController::class,'editBlog'])->name('admin.blog.edit');
Route::put('admin/blog/update/{blog}',[BlogManagementController::class,'updateBlog'])->name('admin.blog.update');
Route::delete('admin/blog/delete/{blog}',[BlogManagementController::class,'deleteBlog'])->name('admin.blog.delete');







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

Route::get('/session-expire',[HomeController::class, 'sessionExpire'])->name('session.expire');

Route::get('user/terms',[HomeController::class, 'showUserTermsandCondition'])->name('user.terms');
Route::get('user/privacy',[HomeController::class, 'showPrivacyPolicy'])->name('user.privacy');




Route::middleware(['user.type:1'])->group(function () {


Route::get('user/consumer/profile', [UserController::class, 'showUserprofile'])->name('user.consumer.profile.show');
Route::get('user/consumer/blogs', [BlogController::class, 'showConsumerBlogs'])->name('user.consumer.blog');
Route::get('user/consumer/orders', [OrderController::class, 'showOrders'])->name('user.consumer.order');
Route::get('user/consumer/order/{id}', [OrderController::class, 'showOrderDetails'])->name('user.consumer.order.details');
Route::get('user/consumer/order/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('user.consumer.order.cancel');
Route::post('user/consumer/order/cancel/{id}', [OrderController::class, 'cancelOrderSubmit'])->name('user.consumer.order.cancel.submit');
Route::get('user/consumer/order/track/{id}', [OrderController::class, 'showOrderDetails'])->name('user.consumer.order.track');
Route::post('/order/confirm', [OrderController::class, 'confirmOrderReceived'])->name('user.order.confirm');
Route::get('user/consumer/order/rate/{id}', [OrderController::class, 'rateOrder'])->name('user.consumer.order.rate');
Route::post('user/consumer/order/rate/store', [OrderController::class, 'storeOrderRating'])->name('user.consumer.order.rate.store');

});


Route::middleware(['user.type:2'])->group(function () {



Route::get('user/farmer', [HomeController::class, 'showFarmDashboard'])->name('user.farmer');
Route::get('/user/farmer/profile', [UserController::class, 'showFarmerprofile'])->name('user.farmer.profile.show');
Route::get('user/farmer/blogs', [BlogController::class, 'showFarmerBlogs'])->name('user.farmer.blog');
Route::get('user/farmer/chat', [ChatController::class, 'showFarmerChat'])->name('user.farmer.chat');
Route::get('user/farmer/supply-products', [FarmerProduceController::class, 'showFarmerSupplyProduct'])->name('user.farmer.supply.product');
Route::post('user/farmer/add-product', [FarmerProduceController::class, 'saveFarmerSupplyProduct'])->name('user.farmer.supply.product.save');
Route::get('user/farmer/supply/product/edit', [FarmerProduceController::class, 'editProduct'])->name('user.farmer.supply.product.edit');
Route::post('user/farmer/supply/product/update', [FarmerProduceController::class, 'saveEditProduct'])->name('user.farmer.supply.product.update');
Route::post('user/farmer/supply/product/delete', [FarmerProduceController::class, 'deleteProduct'])->name('user.farmer.supply.product.delete');




});

//Dashboard for Users

//farmer profiles
Route::get('user/farmer/profile', [UserController::class, 'showFarmerprofile'])->name('user.farmer.profile');
// Route::get('user/farmer/profile/edit', [UserController::class, 'editFarmerprofile'])->name('user.farmer.profile.edit');
// Route::put('user/farmer/profile/update', [UserController::class, 'updateFarmerprofile'])->name('user.farmer.profile.update');

//Product for Consumers
Route::get('user/consumer/products', [UserProductController::class, 'showConsumerProduct'])->name('user.consumer.product');
Route::get('user/consumer/product/view/{encryptedId}', [UserProductController::class, 'viewConsumerProduct'])->name('user.consumer.product.view');


//Cart for Consumers
Route::get('user/consumer/cart', [CartController::class, 'showConsumerCart'])->name('user.consumer.product.cart');
Route::get('/user/consumer/product/cart/checkout/{cartId}', [CartController::class, 'showConsumerCheckout'])
    ->name('user.consumer.product.cart.checkout');

Route::get('user/consumer/favorites', [FavoriteController::class, 'showConsumerFavorites'])->name('user.consumer.favorites');

Route::get('user/consumer/chat', [ChatController::class, 'showConsumerChat'])->name('user.consumer.chat');

Route::get('user/consumer/voting', [VotedProductsController::class, 'showConsumerVoting'])->name('user.consumer.voting');
Route::post('user/consumer/voting', [VotedProductsController::class, 'suggestProduct'])->name('user.consumer.voting.suggest');


//Product for Farmers
Route::get('user/farmer/product', [UserController::class, 'showFarmerProduct'])->name('user.farmer.product');
Route::get('user/farmer/product/view/{id}', [UserController::class, 'viewFarmerProduct'])->name('user.farmer.product.view');



































//This is just random test Codes
// Route::get('/generate-chart', function () {
//     $chartData = [
//         'labels' => ['January', 'February', 'March', 'April'],
//         'values' => [100, 200, 150, 300],
//         'filename' => 'sales_chart_' . time(),
//     ];

//     // Pass data to Node.js script
//     $jsonData = json_encode($chartData);



//     // Adjust script path to match `resources/js`
//     $nodeScriptPath = base_path('resources/js/generateChart.cjs');

//     // Use `node` to execute the script
//     $command = "node $nodeScriptPath '" . addslashes($jsonData) . "'";
//     exec($command, $output, $returnCode);

//     dd($output, $returnCode);

//     // Handle errors
//     if ($returnCode !== 0) {
//         return response()->json(['error' => 'Failed to generate chart.'], 500);
//     }

//     // Return the chart file URL
//     $chartPath = asset("charts/{$chartData['filename']}.png");
//     return response()->json(['chart_url' => $chartPath]);
// });

// Route::get('/test-mail', function () {
//     $recipient = 'testgmail@gmail.com'; // Replace with your email address
//     Mail::to($recipient)->send(new testmail());

//     return "Test email sent successfully to {$recipient}!";
// });
