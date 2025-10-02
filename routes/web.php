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
Route::GET('/produtos/{$code}', [ProductController::class, 'show'])->name('products.show');

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

//dashboard ONLY ADMS
Route::middleware(['auth', AuthAdminMiddleware::class])->group(function (){
    Route::GET('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::GET('/admin/dashboard/photos', [DashboardController::class, 'photo_index'])->name('dashboard.photos');
    Route::GET('/admin/dashboard/search', [DashboardController::class, 'search_edit'])->name('dashboard.search');
    Route::GET('/admin/dashboard/search/photos', [DashboardController::class, 'search_photos'])->name('dashboard.search_photos');

    Route::POST('/admin/dashboard/photos', [DashboardController::class, 'edit'])->name('admin.photo');
    Route::POST('/admin/dashboard/update', [DashboardController::class, 'update'])->name('admin.update');
    Route::POST('/admin/dashboard/destroy', [DashboardController::class, 'destroy'])->name('admin.destroy');
    Route::POST('/admin/dashboard/clear', [DashboardController::class, 'clear'])->name('admin.clear');
    Route::POST('/admin/dashboard/store', [DashboardController::class, 'store'])->name('admin.store');

    Route::view('/admin/dashboard/destroy', 'admin.dashboard_destroy')->name('dashboard.destroy');
    Route::view('/admin/dashboard/clear', 'admin.dashboard_clear')->name('dashboard.clear');
    Route::view('/admin/dashboard/add', 'admin.dashboard_add')->name('dashboard.add');
});

