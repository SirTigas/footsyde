<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AuthAdminMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//breeze acima --------------------------------------------------------------------------------------------------->

Route::GET('/home', [HomeController::class, 'index'])->name('site.home');
Route::GET('', function(){
    return redirect()->route('site.home');
});

//product
Route::prefix('produtos/')->group(function () {
    Route::GET('', [ProductController::class, 'index'])->name('products.index');
    Route::GET('categorias/homem', [ProductController::class, 'man'])->name('products.man');
    Route::GET('categorias/mulher', [ProductController::class, 'woman'])->name('products.woman');
    Route::GET('categorias/unissex', [ProductController::class, 'unissex'])->name('products.unissex');
    Route::GET('busca', [ProductController::class, 'search'])->name('products.search');
    Route::GET('{code}', [ProductController::class, 'show'])->name('products.show');
});

//about
Route::GET('/sobre', [SobreController::class, 'index'])->name('site.sobre');

//cart-list
Route::middleware('auth')->group(function () {
    Route::resource('carrinho', CartController::class);
    Route::POST('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});

//wishlist
Route::middleware('auth')->group(function () {
    Route::resource('favoritos', WishlistController::class);
    Route::POST('/wish/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
});

// //login/register/logout
// Route::resource('users', UserController::class);
// Route::view('/login', 'login.form')->name('login');
// Route::POST('/auth', [LoginController::class, 'auth'])->name('login.auth');
// Route::GET('/logout', [LoginController::class, 'logout'])->name('login.logout');
// Route::GET('/register', [UserController::class, 'create'])->name('register');

//Checkout
Route::middleware('auth')->group(function () {
    Route::GET('/checkout', [OrderController::class, 'index'])->name('site.checkout');
});

//dashboard ONLY ADMS
Route::middleware(['auth', AuthAdminMiddleware::class])->group(function (){
    Route::GET('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::GET('/admin/dashboard/stock', [DashboardController::class, 'stock_index'])->name('dashboard.stock');
    Route::GET('/admin/dashboard/photos', [DashboardController::class, 'photo_index'])->name('dashboard.photos');
    Route::GET('/admin/dashboard/search', [DashboardController::class, 'search_edit'])->name('dashboard.search');
    Route::GET('/admin/dashboard/search/photos', [DashboardController::class, 'search_photos'])->name('dashboard.search_photos');

    Route::POST('/admin/dashboard/stock', [DashboardController::class, 'update_stock'])->name('admin.stock');
    Route::POST('/admin/dashboard/photos', [DashboardController::class, 'update_photo'])->name('admin.photo');
    Route::POST('/admin/dashboard/update', [DashboardController::class, 'update'])->name('admin.update');
    Route::POST('/admin/dashboard/destroy', [DashboardController::class, 'destroy'])->name('admin.destroy');
    Route::POST('/admin/dashboard/clear', [DashboardController::class, 'clear'])->name('admin.clear');
    Route::POST('/admin/dashboard/store', [DashboardController::class, 'store'])->name('admin.store');

    Route::view('/admin/dashboard/destroy', 'admin.dashboard_destroy')->name('dashboard.destroy');
    Route::view('/admin/dashboard/clear', 'admin.dashboard_clear')->name('dashboard.clear');
    Route::view('/admin/dashboard/add', 'admin.dashboard_add')->name('dashboard.add');
});

Route::fallback(function () {
    return redirect()->route('site.home');
});
