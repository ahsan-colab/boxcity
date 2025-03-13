<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/load-more-products', [HomeController::class, 'loadMoreProducts'])->name('products.load-more');
