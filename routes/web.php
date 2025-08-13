<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::GET('/', [HomeController::class, 'index'])->name('site.home');

Route::resource('/produtos', ProductController::class);
Route::GET('/produtos/{$slug}', [ProductController::class, 'show'])->name('products.show');

Route::GET('/sobre', [SobreController::class, 'index'])->name('site.sobre');

Route::GET('/cart-list', [CartItemController::class, 'index'])->name('site.cart');

Route::view('/login', 'login.form')->name('login.form');
Route::POST('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::GET('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::GET('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
