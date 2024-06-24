<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MyStoreController;


Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/login', [LoginController::class, 'loginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'registForm'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'createAccount'])->middleware('guest');

Route::get('/category/{category}', [ProductController::class, 'getProductsByCategory']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password')->middleware('auth');
Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password')->middleware('auth');


// Route untuk halaman "Toko Saya"
Route::get('/toko-saya', [MyStoreController::class, 'index'])->name('my-store.index');

// Route untuk mengunggah produk
Route::post('/my-store/upload', [MyStoreController::class, 'upload'])->name('my-store.upload');