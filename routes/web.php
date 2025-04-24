<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/post-contact', [FormController::class, 'submitContactForm'])->name('submit.contact');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('submit.newsletter');
Route::get('/confirm-subscription/{token}', [SubscriptionController::class, 'confirm'])->name('subscription.confirm');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/load-more-products', [HomeController::class, 'loadMoreProducts'])->name('products.load-more');
Route::get('/thank-you', [CheckOutController::class, 'thankyou'])->name('checkout.thankyou');


//temp
Route::get('/subscription/confirmation', function () {
    return view('subscription.confirmed');
})->name('subscription.confirmation');
