<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/{id}', function ($id) {

    $response = Http::get("https://app.ecwid.com/api/v3/109333282/products/{$id}");
    $product = $response->json();
    return view('layouts.product', ['productId' => $id]);
});

Route::get('/thank-you', function () {
    return view('layouts.orderthankyou');
})->name('thank.you');


Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout'); // GET route for displaying the page
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/load-more-products', [HomeController::class, 'loadMoreProducts'])->name('products.load-more');
