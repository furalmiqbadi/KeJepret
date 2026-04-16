<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kejepret', [HomeController::class, 'kejepret'])->name('kejepret');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/koleksi', [HomeController::class, 'koleksi'])->name('koleksi');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
