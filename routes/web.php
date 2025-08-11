<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\CartItemController;

Route::get('/', [HomeController::class, 'index'])->name('site.home');

Route::resource('/produtos', ProductController::class);

Route::get('/produtos/{$slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/sobre', [SobreController::class, 'index'])->name('site.sobre');

Route::get('/cart-item', [CartItemController::class, 'index'])->name('site.cart');
