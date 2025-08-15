<?php
use App\Http\Controllers\AdminProfileController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingAddressController;

Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [AuthController::class, 'login']);
Route::post('admin/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // Customer order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Shipping address routes
    Route::get('/shipping-addresses', [ShippingAddressController::class, 'index'])->name('shipping_addresses.index');
    Route::post('/shipping-addresses', [ShippingAddressController::class, 'store'])->name('shipping_addresses.store');
    Route::put('/shipping-addresses/{id}', [ShippingAddressController::class, 'update'])->name('shipping_addresses.update');
    Route::delete('/shipping-addresses/{id}', [ShippingAddressController::class, 'destroy'])->name('shipping_addresses.destroy');
});

Route::get('/', function () {
    return view('website.home');
})->name('website.home');

Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('website.product.details');

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'websiteIndex'])->name('website.products');

Route::get('/product_details', function () {
    return view('website.product_details');
});

Route::get('/about', function () {
    return view('website.about');
});

Route::get('/insights', function () {
    return view('website.blog');
});

Route::get('/contact', function () {
    return view('website.contact');
});


// Cart routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');

Route::get('/checkout', function () {
    return view('website.checkout');
})->name('checkout');

Route::get('/login', [CustomerRegisterController::class, 'showLoginForm'])->name('customer.login');
Route::post('/login', [CustomerRegisterController::class, 'login'])->name('customer.login.submit');
Route::get('/register', [CustomerRegisterController::class, 'showForm'])->name('customer.register');
Route::post('/register', [CustomerRegisterController::class, 'register'])->name('customer.register.submit');
Route::post('/logout', [CustomerRegisterController::class, 'logout'])->name('customer.logout');

Route::middleware(['auth', 'admin.only'])->prefix('admin')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('brands', \App\Http\Controllers\BrandController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('discounts', \App\Http\Controllers\DiscountController::class);
    Route::delete('products/images/{id}', [\App\Http\Controllers\ProductController::class, 'destroyImage'])->name('products.destroyImage');
    Route::post('products/upload-image', [\App\Http\Controllers\ProductController::class, 'uploadImage'])->name('products.uploadImage');
    // Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    //     Route::resource('blogs', App\Http\Controllers\AdminBlogController::class, [
    //         'as' => 'admin'
    //     ]);
    // });
    Route::resource('blogs', App\Http\Controllers\AdminBlogController::class, [
        'as' => 'admin'
    ]);
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
    Route::get('/orders/{id}/edit', [OrderController::class, 'adminEdit'])->name('admin.orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'adminUpdate'])->name('admin.orders.update');

    // Admin customer management
    Route::get('/customers', [\App\Http\Controllers\AdminCustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/customers/{id}', [\App\Http\Controllers\AdminCustomerController::class, 'show'])->name('admin.customers.show');
    Route::get('profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});