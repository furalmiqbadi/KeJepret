<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\DownloadController;
use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

// ═══════════════════════════════
// PUBLIC
// ═══════════════════════════════
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// ═══════════════════════════════
// PROTECTED — Semua role
// ═══════════════════════════════
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // ───────────────────────────
    // RUNNER
    // ───────────────────────────
    Route::middleware('role:runner')->group(function () {
        Route::post('/search/enroll',   [SearchController::class, 'enroll']);
        Route::post('/search',          [SearchController::class, 'search']);
        Route::get('/search/history',   [SearchController::class, 'history']);

        Route::get('/cart',             [CartController::class, 'index']);
        Route::post('/cart/add',        [CartController::class, 'add']);
        Route::delete('/cart/{id}',     [CartController::class, 'remove']);

        Route::post('/checkout',        [OrderController::class, 'checkout']);
        Route::get('/orders',           [OrderController::class, 'history']);
        Route::get('/orders/{id}',      [OrderController::class, 'detail']);

        Route::get('/download/{token}', [DownloadController::class, 'download']);
    });

    // ───────────────────────────
    // FOTOGRAFER
    // ───────────────────────────
    Route::middleware(['role:photographer', 'photographer.verified'])->group(function () {
        Route::post('/photos/upload',       [PhotoController::class, 'upload']);
        Route::get('/photos',               [PhotoController::class, 'index']);
        Route::put('/photos/{id}/price',    [PhotoController::class, 'updatePrice']);
        Route::get('/dashboard/sales',      [BalanceController::class, 'sales']);
        Route::get('/balance',              [BalanceController::class, 'index']);
        Route::post('/withdraw',            [BalanceController::class, 'withdraw']);
    });

    // ───────────────────────────
    // ADMIN
    // ───────────────────────────
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/photographers/pending',        [AdminController::class, 'pendingPhotographers']);
        Route::post('/photographers/{id}/verify',   [AdminController::class, 'verifyPhotographer']);
        Route::post('/photographers/{id}/reject',   [AdminController::class, 'rejectPhotographer']);

        Route::get('/events',                       [AdminController::class, 'listEvents']);
        Route::post('/events',                      [AdminController::class, 'createEvent']);
        Route::put('/events/{id}',                  [AdminController::class, 'updateEvent']);

        Route::get('/withdrawals/pending',          [AdminController::class, 'pendingWithdrawals']);
        Route::post('/withdrawals/{id}/approve',    [AdminController::class, 'approveWithdrawal']);
        Route::post('/withdrawals/{id}/reject',     [AdminController::class, 'rejectWithdrawal']);

        Route::put('/photos/{id}/deactivate',       [AdminController::class, 'deactivatePhoto']);
    });

    // ───────────────────────────
    // TRIPAY WEBHOOK
    // ───────────────────────────
    Route::post('/tripay/webhook', [OrderController::class, 'webhook']);
});