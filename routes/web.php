<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Jobs\FetchCategoriesFromApi;
use App\Http\Controllers\PayPalController;

// Homepage route — loads the main page and first product list
Route::get('/', [ProductController::class, 'index'])->name('home');
// AJAX pagination route — loads only product list HTML
Route::get('/products/paginate', [ProductController::class, 'paginateProducts'])->name('products.paginate');

Route::post('/post-contact', [FormController::class, 'contactForm'])->name('submit.contact');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('submit.newsletter');
Route::get('/confirm-subscription/{token}', [SubscriptionController::class, 'confirm'])->name('subscription.confirm');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category-level', [CategoryController::class, 'getProductsByCategoryLevel'])->name('category.level');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/product', [ProductController::class, 'index'])->name('product');
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

Route::get('/fetch-categories', function () {
    Artisan::call('fetch:categories');
    return response()->json(['status' => 'Command executed successfully']);
});

//temp
Route::get('/subscription/confirmation', function () {
    return view('subscription.confirmed');
})->name('subscription.confirmation');


Route::post('/paypal/create-order', [PayPalController::class, 'createOrder'])->name('paypal.create');
Route::get('/paypal/capture-order', [PayPalController::class, 'captureOrder'])->name('paypal.capture');
Route::get('/paypal/success', [PayPalController::class, 'captureOrder'])->name('paypal.success');
Route::get('/paypal/cancel', function () {return 'Payment was cancelled.';})->name('paypal.cancel');
