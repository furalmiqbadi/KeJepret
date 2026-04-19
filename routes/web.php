<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;

use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/kejepret', [HomeController::class, 'kejepret'])->name('kejepret');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/koleksi', [HomeController::class, 'koleksi'])->name('koleksi');
    Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
    Route::post('/profile/face/enroll', [App\Http\Controllers\ProfileController::class, 'enroll'])->name('face.enroll');
    Route::post('/face/delete/{id}', [App\Http\Controllers\ProfileController::class, 'deleteFace'])->name('face.delete');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register/fotografer', [AuthController::class, 'showRegisterFotografer'])->name('register.fotografer');
Route::post('/register/fotografer', [AuthController::class, 'registerFotografer']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('demo')->group(function () {
    // Halaman 1: Upload Foto Event
    Route::get('/upload', [DemoController::class, 'uploadView'])->name('demo.upload');
    Route::post('/upload/process', [DemoController::class, 'uploadProcess'])->name('demo.upload.process');

    // Halaman 2: Search Wajah (Nanti kita buat)
    Route::get('/search', [DemoController::class, 'searchView'])->name('demo.search');
    Route::post('/search/process', [DemoController::class, 'searchProcess'])->name('demo.search.process');
});