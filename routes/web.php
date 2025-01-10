<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Wallet\DepositController;
use App\Http\Controllers\Wallet\TransactionController;
use App\Http\Controllers\Wallet\WithdrawController;
use App\Models\KycController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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
})->middleware(['auth', 'redirect-if-admin'])->name('dashboard');

//Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'redirect-if-admin')->group(function () {
    //Wallet Routes
    Route::prefix('wallet')->name('wallet.')->group(function () {
        Route::get('deposit', [DepositController::class, 'index'])->name('deposit.index');
        Route::post('deposit', [DepositController::class, 'store'])->name('deposit.store');
        Route::get('check-balance/{user?}', [DepositController::class, 'checkBalance'])->name('check-balance');
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
        Route::post('withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');
    });
    Route::post('kyc', [KycController::class, 'store'])->name('kyc.store');
    Route::resource('add', AddController::class);
    Route::get('marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
});

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){
        Route::get('login-as/{user}', function (Request $request, User $user) {
            session()->set('impersonating', [
                'current'=> $user->uuid,
                'old' => auth()->user()->uuid
            ]);
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Auth::loginUsingId($user->id, false);
            return redirect(route('dashboard'));
        })->name('login-as');
    });
require __DIR__.'/auth.php';
require __DIR__.'/chat.php';

