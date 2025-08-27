<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AuthAdminMiddleware;

Route::GET('/', [HomeController::class, 'index'])->name('site.home');

//product
Route::resource('produtos', ProductController::class);
Route::GET('/produtos/categorias/homem', [ProductController::class, 'man'])->name('products.man');
Route::GET('/produtos/categorias/mulher', [ProductController::class, 'woman'])->name('products.woman');
Route::GET('/produtos/categorias/unissex', [ProductController::class, 'unissex'])->name('products.unissex');
Route::GET('/produto/busca', [ProductController::class, 'search'])->name('products.search');
Route::GET('/produtos/{$slug}', [ProductController::class, 'show'])->name('products.show');

//about
Route::GET('/sobre', [SobreController::class, 'index'])->name('site.sobre');

//cart-list
Route::middleware('auth')->group(function () {
    Route::resource('cartitem', CartController::class);
    Route::GET('/carrinho', [CartController::class, 'index'])->name('site.cart');
    Route::POST('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::POST('/cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::POST('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});

//wishlist
Route::middleware('auth')->group(function () {
    Route::resource('favitem', WishlistController::class);
    Route::GET('/favoritos', [WishlistController::class, 'index'])->name('site.wishlist');
    Route::POST('/wish/destroy', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::POST('/wish/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');

});

//login/register/logout
Route::resource('users', UserController::class);
Route::view('/login', 'login.form')->name('login');
Route::POST('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::GET('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::GET('/register', [UserController::class, 'create'])->name('register');

//dashboard
Route::middleware(['auth', AuthAdminMiddleware::class])->group(function (){
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

