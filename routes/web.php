<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\IsLogin;





Route::get('/', [UserController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



// category get route 
Route::get('/addCategory', [CategoryController::class, 'index'])->name('Admin.addCategory');
Route::post('/addCategory', [CategoryController::class, 'store'])->name('Admin.addCategoryStore');
Route::get('/addProduct', [ProductController::class, 'index'])->name('Admin.addProduct');
Route::post('/addProduct', [ProductController::class, 'store'])->name('Admin.addProductStore');
Route::get('/productList', [CategoryController::class, 'index'])->name('Admin.productList');
