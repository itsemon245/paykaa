<?php

namespace App\Http\Controllers\Wallet;

use App\Data\WalletData;
use App\Data\WithdrawMethodData;
use App\Enum\Wallet\WalletTransactionType;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Wallet;
use App\Models\WithdrawMethod;
use App\Services\Wallet as WalletService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class WithdrawController extends Controller
{
    public function __construct(public WalletService $wallet) {}
    public function canWithdraw()
    {
        return !Wallet::where(function (Builder $q) {
            $q->whereNull('approved_at');
            $q->whereNull('cancelled_at');
            $q->where('transaction_type', WalletTransactionType::WITHDRAW->value);
        })->exists();
    }
    public function index()
    {
        $withdrawMethods = WithdrawMethod::all();
        $canWithdraw = $this->canWithdraw();
        return Inertia::render('Wallet/Withdraw', [
            'balance' => Wallet::getBalance(),
            'withdrawMethods' => WithdrawMethodData::collect($withdrawMethods),
            'canWithdraw' => $canWithdraw,
        ]);
    }

    public function store(Request $request)
    {
        if (!$this->canWithdraw()) {
            return back()->with('error', "You already have a withdraw pending!");
        }
        $minWithdrawAmount = Setting::first()->transactions['min_withdraw_amount'] ?? 1;

        $balance = Wallet::getBalance();
        $request->validate([
            'amount' => ['required', 'numeric', "min:$minWithdrawAmount", "max:$balance"],
        ], [
            'amount.max' => 'The amount must be less than or equal to your balance: ' . $balance . " BDT",
        ]);
        $data = WalletData::from($request->all());
        $wallet = $this->wallet;
        return backWithError(function () use ($data, $wallet) {
            $wallet->withdraw($data);
            return back();
        });
    }
}
