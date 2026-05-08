<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BalanceController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\DownloadController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\PhotoController;
use App\Http\Controllers\Web\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

// FIX 3: Guard /home dan /profil — redirect photographer ke halaman mereka
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/event', [HomeController::class, 'event'])->name('event');
Route::get('/event/{id}', [HomeController::class, 'eventDetail'])->name('event.detail');
Route::get('/search', [SearchController::class, 'showSearch'])->name('search');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/banned', function () {
    return view('banned');
})->name('banned');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/register/photographer', [AuthController::class, 'showRegisterPhotographer'])->name('register.photographer');
    Route::post('/register/photographer', [AuthController::class, 'registerPhotographer'])->name('register.photographer.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::middleware('role:runner')->prefix('runner')->group(function () {
        Route::get('/search', [SearchController::class, 'showSearch'])->name('runner.search');
        Route::post('/search', [SearchController::class, 'search'])->name('runner.search.post');
        Route::get('/search/results/{id}', [SearchController::class, 'results'])->name('runner.search.results');
        Route::get('/enroll', [SearchController::class, 'showEnroll'])->name('runner.enroll');
        Route::get('/search/history', [SearchController::class, 'history'])->name('runner.search.history');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
        Route::get('/orders', [OrderController::class, 'history'])->name('order.history');
        Route::get('/orders/{id}', [OrderController::class, 'detail'])->name('order.detail');
        Route::post('/orders/{id}/pay', [OrderController::class, 'manualPay'])->name('order.pay');
        Route::get('/download/{token}', [DownloadController::class, 'download'])->name('download');
    });

    // FIX 1: Tambah route photographer.waiting
    // FIX 2: Tambah middleware photographer.verified di group photographer
    Route::middleware(['role:photographer', 'banned'])->prefix('photographer')->group(function () {

        // Route waiting — TANPA middleware photographer.verified
        // agar photographer pending bisa akses halaman ini
        Route::get('/waiting', function () {
            return view('photographer.waiting');
        })->name('photographer.waiting');

        // Semua route di bawah ini butuh verified
        Route::middleware('photographer.verified')->group(function () {
            Route::get('/portfolio', [PhotoController::class, 'index'])->name('photographer.portfolio');
            Route::get('/upload', [PhotoController::class, 'showUpload'])->name('photographer.upload');
            Route::post('/upload', [PhotoController::class, 'upload'])->name('photographer.upload.post');
            Route::put('/photos/{id}/price', [PhotoController::class, 'updatePrice'])->name('photographer.photos.price.post');
            Route::get('/profil', [BalanceController::class, 'index'])->name('photographer.profil');
            Route::get('/sales', [BalanceController::class, 'sales'])->name('balance.sales');
            Route::post('/withdraw', [BalanceController::class, 'withdraw'])->name('balance.withdraw.post');
        });
    });

    Route::middleware('role:admin')->get('/admin/dashboard', function () {
        return redirect()->route('filament.admin.pages.dashboard');
    })->name('admin.dashboard');
});
