<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/load-more-products', [ProductController::class, 'loadMoreProducts'])->name('products.load-more');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/thank-you', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');


Route::get('/fetch-products', function () {
    Artisan::call('fetch:products');
    return response()->json(['status' => 'Command executed successfully']);
});
