<?php

use App\Data\EarningData;
use App\Data\UserData;
use App\Enum\Status;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Http\Controllers\AddController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\MoneyRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Wallet\DepositController;
use App\Http\Controllers\Wallet\TransactionController;
use App\Http\Controllers\Wallet\WithdrawController;
use App\Models\KycController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Models\Earning;
use App\Models\LandingPage;
use App\Models\Setting;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

// Route::get('/sw.js', function () {
//     return response()->file(public_path('build/sw.js'), [
//         'Content-Type' => 'application/javascript',
//     ]);
// });
Route::get('/', function () {
    $landing = LandingPage::first();
    return view('landing', compact('landing'));
    // return Inertia::render('Landing/Index');
});
Route::post('/upload/chunk', [UploadController::class, 'store'])->name('upload.chunk.start');
Route::patch('/upload/chunk', [UploadController::class, 'update'])->name('upload.chunk.update');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'redirect-if-admin', 'verified'])->name('dashboard');

//Profile Routes
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('update-active-status/', function () {
        $user = User::find(auth()->id());
        $user->setActiveNow();
        return response()->json(['success' => true]);
    })->name('active-status.update');

    Route::post('check-active-status/{user?}', function (User $user) {
        return response()->json(['active_status' => $user->active_status]);
    })->name('active-status.check');
});

Route::middleware('auth', 'redirect-if-admin', 'verified')->group(function () {
    Route::get('notification/mark-all-as-read', function () {
        $user = User::find(auth()->id());
        $user->notifications()->update(['read_at' => now()]);
        return back();
    })->name('notification.mark-all-as-read');
    Route::get('notification/clear-all', function () {
        $user = User::find(auth()->id());
        $user->notifications()->where(function (Builder $builder) {
            $builder->whereJsonContains('data->moneyRequest->status', Status::CANCELLED->value)
                ->orWhereJsonContains('data->moneyRequest->status', Status::REJECTED->value)
                ->orWhereJsonContains('data->moneyRequest->status', Status::RELEASED->value);
        })->delete();
        return back()->with('success', 'Cleared completed notifications');
    })->name('notification.clear-all');
    Route::post('send-money-verify-password', [TransactionController::class, 'sendMoneyVerifyPassword'])->name('send-money.verify-password');
    Route::post('send-money', [TransactionController::class, 'sendMoneyStore'])->name('send-money.store');
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
    Route::post('money-request', [MoneyRequestController::class, 'request'])->name('money.request');
    Route::post('money-request/{moneyRequest}/accept', [MoneyRequestController::class, 'accept'])->name('money.accept');
    Route::post('money-request/{moneyRequest}/cancel', [MoneyRequestController::class, 'cancel'])->name('money.cancel');
    Route::post('money-request/{moneyRequest}/reject', [MoneyRequestController::class, 'reject'])->name('money.reject');
    Route::post('money-request/{moneyRequest}/request-to-release', [MoneyRequestController::class, 'requestToRelease'])->name('money.request-release');
    Route::post('money-request/{moneyRequest}/release', [MoneyRequestController::class, 'release'])->name('money.release');
    Route::post('money-request/{moneyRequest}/report', [MoneyRequestController::class, 'report'])->name('money.report');


    Route::get('referrals', function () {
        $referrals = User::find(auth()->id())->referrals;
        return Inertia::render('Referall/Index', [
            'referrals' => UserData::collect($referrals)
        ]);
    })->name('referrals.index');

    Route::get('earnings', function () {
        $earnings = Earning::where('user_id', auth()->id())
            ->with('user', 'from')
            ->get();
        return Inertia::render('Referall/Earnings', [
            'earnings' => EarningData::collect($earnings),
        ]);
    })->name('earnings.index');
    Route::post('earnings/{from_id}', function (int $from_id) {
        $minEarnableAmount = (int)Setting::first()->transactions['min_earnable_amount'];
        $earnings = Earning::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->where('from_id', $from_id)
            ->sum('amount');
        if ($earnings < $minEarnableAmount) {
            return back()->with('error', 'Not enough earnings');
        }
        Wallet::create([
            'owner_id' => auth()->id(),
            'user_id' => $from_id,
            'transaction_type' => WalletTransactionType::EARN->value,
            'type' => WalletType::CREDIT->value,
            'amount' => $earnings,
            'currency' => 'bdt',
            'approved_at' => now(),
            'note' => "Earnings from user {$from_id}",
        ]);
        Earning::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->where('from_id', $from_id)
            ->update(['status' => 'converted']);

        return back();
    })->name('earnings.convert');
});

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('login-as/{user}', function (Request $request, User $user) {
            if (!auth()->user()->isAdmin()) {
                $oldUser = User::where('uuid', session('impersonating.old'))->first();
                if (!$oldUser?->isAdmin()) {
                    abort(403);
                }
            } else {
                session(['impersonating' => [
                    'current' => $user->uuid,
                    'old' => auth()->user()->uuid,
                    'backUrl' => url()->previous()
                ]]);
            }
            Auth::guard('web')->logout();
            Auth::loginUsingId($user->id, false);
            if ($user->isAdmin()) {
                $url = session('impersonating.backUrl');
                session()->forget('impersonating');
                return redirect($url);
            }
            $redirect = request()->query('redirect', route('dashboard'));
            return redirect($redirect)->with('success', 'Logged in as user');
        })->name('login-as');
    });

Route::get('/download', function () {
    return streamFile(public_path('paykaa.apk'), 'PayKaa.apk');
})
    ->name('download')
    ->middleware('throttle:20,1');
require __DIR__ . '/auth.php';
require __DIR__ . '/chat.php';
