<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\PhotoController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\SearchController;
use App\Http\Controllers\Web\BalanceController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\DownloadController;
use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════
// EXISTING ROUTES — JANGAN DIHAPUS!
// ══════════════════════════════════════════
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kejepret', [HomeController::class, 'kejepret'])->name('kejepret');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/koleksi', [HomeController::class, 'koleksi'])->name('koleksi');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');

Route::prefix('demo')->group(function () {
    Route::get('/upload', [DemoController::class, 'uploadView'])->name('demo.upload');
    Route::post('/upload/process', [DemoController::class, 'uploadProcess'])->name('demo.upload.process');
    Route::get('/search', [DemoController::class, 'searchView'])->name('demo.search');
    Route::post('/search/process', [DemoController::class, 'searchProcess'])->name('demo.search.process');
});

// ══════════════════════════════════════════
// TEST ROUTES — Hapus setelah testing selesai!
// ══════════════════════════════════════════
Route::prefix('test')->group(function () {
    Route::get('/auth',     fn() => view('test.auth'))->name('test.auth');
    Route::get('/cart',     fn() => view('test.cart'))->name('test.cart');
    Route::get('/order',    fn() => view('test.order'))->name('test.order');
    Route::get('/photo',    fn() => view('test.photo'))->name('test.photo');
    Route::get('/search',   fn() => view('test.search'))->name('test.search');
    Route::get('/balance',  fn() => view('test.balance'))->name('test.balance');
    Route::get('/admin',    fn() => view('test.admin'))->name('test.admin');
    Route::get('/download', fn() => view('test.download'))->name('test.download');
});

// ══════════════════════════════════════════
// AUTH ROUTES (Guest only)
// ══════════════════════════════════════════
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// ══════════════════════════════════════════
// AUTHENTICATED ROUTES
// ══════════════════════════════════════════
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // ════════════════════════════════
    // RUNNER ROUTES
    // ════════════════════════════════
    Route::middleware('role:runner')->prefix('runner')->group(function () {
        Route::get('/dashboard', fn() => view('runner.dashboard'))->name('runner.dashboard');
        Route::get('/search', [SearchController::class, 'showSearch'])->name('runner.search');
        Route::post('/search', [SearchController::class, 'search'])->name('runner.search.post');
        Route::get('/enroll', [SearchController::class, 'showEnroll'])->name('runner.enroll');
        Route::post('/enroll', [SearchController::class, 'enroll'])->name('runner.enroll.post');
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

    // ════════════════════════════════
    // PHOTOGRAPHER ROUTES
    // ════════════════════════════════
    Route::middleware('role:photographer')->prefix('photographer')->group(function () {
        Route::get('/dashboard', fn() => view('photographer.dashboard'))->name('photographer.dashboard');
        Route::get('/photos', [PhotoController::class, 'index'])->name('photographer.photos');
        Route::get('/photos/upload', [PhotoController::class, 'showUpload'])->name('photographer.photos.upload');
        Route::post('/photos/upload', [PhotoController::class, 'upload'])->name('photographer.photos.upload.post');
        Route::get('/photos/{id}/price', [PhotoController::class, 'showUpdatePrice'])->name('photographer.photos.price');
        Route::put('/photos/{id}/price', [PhotoController::class, 'updatePrice'])->name('photographer.photos.price.post');
        Route::get('/balance', [BalanceController::class, 'index'])->name('balance.index');
        Route::get('/balance/sales', [BalanceController::class, 'sales'])->name('balance.sales');
        Route::get('/balance/withdraw', [BalanceController::class, 'showWithdraw'])->name('balance.withdraw');
        Route::post('/balance/withdraw', [BalanceController::class, 'withdraw'])->name('balance.withdraw.post');
    });

    // ════════════════════════════════
    // ADMIN ROUTES
    // ════════════════════════════════
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/photographers/pending', [AdminController::class, 'pendingPhotographers'])->name('admin.photographers.pending');
        Route::post('/photographers/{id}/verify', [AdminController::class, 'verifyPhotographer'])->name('admin.photographers.verify');
        Route::post('/photographers/{id}/reject', [AdminController::class, 'rejectPhotographer'])->name('admin.photographers.reject');
        Route::get('/events', [AdminController::class, 'listEvents'])->name('admin.events.index');
        Route::get('/events/create', [AdminController::class, 'showCreateEvent'])->name('admin.events.create');
        Route::post('/events', [AdminController::class, 'createEvent'])->name('admin.events.store');
        Route::get('/events/{id}/edit', [AdminController::class, 'showEditEvent'])->name('admin.events.edit');
        Route::put('/events/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
        Route::get('/withdrawals/pending', [AdminController::class, 'pendingWithdrawals'])->name('admin.withdrawals.pending');
        Route::post('/withdrawals/{id}/approve', [AdminController::class, 'approveWithdrawal'])->name('admin.withdrawals.approve');
        Route::post('/withdrawals/{id}/reject', [AdminController::class, 'rejectWithdrawal'])->name('admin.withdrawals.reject');
        Route::put('/photos/{id}/deactivate', [AdminController::class, 'deactivatePhoto'])->name('admin.photos.deactivate');
    });
});
