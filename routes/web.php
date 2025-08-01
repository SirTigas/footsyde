<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('site.home');

Route::get('/produtos', [ProductController::class, 'index'])->name('site.produto');
