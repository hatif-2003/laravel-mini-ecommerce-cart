<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->controller(AdminController::class)->group(function () {
    Route::get('/admin', 'dashboard')->name('admin.dashboard');
    Route::get('/orderlist', 'orderList')->name('order.list');

    // Category CRUD Routes
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
 
});
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/category/{id}', 'categoryProducts')->name('category-products');

    Route::get('/product/{id}', 'showProduct')->name('show-product');

});
Route::middleware('auth')->controller(CartController::class)->group(function () {
    Route::post('/cart/add/{productId}', 'addToCart')->name('cart.add');
    // Add more cart-related routes here
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/increase/{id}', 'increaseQuantity')->name('cart.increase');
    Route::post('/cart/decrease/{id}', 'decreaseQuantity')->name('cart.decrease');
    Route::post('/cart/remove/{id}', 'destroycartItem')->name('cart.remove');

});
Route::middleware('auth')->controller(WishlistsController::class)->group(function () {
    Route::get('/wishlist', 'index')->name('wishlist.index');
    Route::post('/wishlist/add/{productId}', 'addToWishlist')->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', 'removeFromWishlist')->name('wishlist.remove');
});

Route::middleware('auth')->controller(OrdersController::class)->group(function () {
    Route::get('/order', 'index')->name('order.index');
    Route::post('/order/post', 'placeOrder')->name('place-order');
    Route::post('/razorpay/order', 'createRazorpayOrder')->name('razorpay.order');
    Route::post('/razorpay/store', 'store')->name('order.store');
    Route::get('/order/success', 'success')->name('order.success');
});

Route::middleware('auth')->controller(MyOrderController::class)->group(function(){
    Route::get('/myOrders', 'myOrder')->name('myorder');
});








require __DIR__.'/auth.php';
