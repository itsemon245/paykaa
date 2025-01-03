<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Wallet\DepositController;
use App\Http\Controllers\Wallet\TransactionController;
use App\Http\Controllers\Wallet\WithdrawController;
use App\Models\KycController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});
Route::post('/upload/chunk', [UploadController::class, 'store'])->name('upload.chunk.start');
Route::patch('/upload/chunk', [UploadController::class, 'update'])->name('upload.chunk.update');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Wallet Routes
    Route::prefix('wallet')->name('wallet.')->group(function () {
        Route::get('deposit', [DepositController::class, 'index'])->name('deposit.index');
        Route::post('deposit', [DepositController::class, 'store'])->name('deposit.store');
        Route::get('check-balance', [DepositController::class, 'checkBalance'])->name('check-balance');
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
        Route::post('withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');
    });
    Route::post('kyc', [KycController::class, 'store'])->name('kyc.store');
});

require __DIR__.'/auth.php';
require __DIR__.'/chat.php';
