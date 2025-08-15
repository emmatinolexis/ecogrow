<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::middleware('web')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
});
