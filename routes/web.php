<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kejepret', [HomeController::class, 'kejepret'])->name('kejepret');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/koleksi', [HomeController::class, 'koleksi'])->name('koleksi');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');


Route::prefix('demo')->group(function () {
    // Halaman 1: Upload Foto Event
    Route::get('/upload', [DemoController::class, 'uploadView'])->name('demo.upload');
    Route::post('/upload/process', [DemoController::class, 'uploadProcess'])->name('demo.upload.process');

    // Halaman 2: Search Wajah (Nanti kita buat)
    Route::get('/search', [DemoController::class, 'searchView'])->name('demo.search');
    Route::post('/search/process', [DemoController::class, 'searchProcess'])->name('demo.search.process');

    Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect('/'); // Akan diarahkan kembali ke halaman utama setelah logout
})->name('logout');
});