<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::GET('/', [HomeController::class, 'index'])->name('site.home');

//product
Route::resource('/produtos', ProductController::class);
Route::GET('/produtos/{$slug}', [ProductController::class, 'show'])->name('products.show');

//about
Route::GET('/sobre', [SobreController::class, 'index'])->name('site.sobre');

//cart-list
Route::resource('cartitem', CartController::class);
Route::GET('/cart-list', [CartController::class, 'index'])->name('site.cart');

//login/register/logout
Route::resource('users', UserController::class);
Route::view('/login', 'login.form')->name('login');
Route::POST('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::GET('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::GET('/register', [UserController::class, 'create'])->name('register');

//dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('admin.dashboard');
