<?php

namespace App\Http\Controllers\Wallet;

use App\Data\WalletData;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Services\Wallet as WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class WithdrawController extends Controller
{
    public function __construct(public WalletService $wallet){
    }
    public function index()
    {
        return Inertia::render('Wallet/Withdraw', ['balance'=> Wallet::getBalance()]);
    }

    public function store(Request $request)
    {
        $balance = Wallet::getBalance();
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1', 'max:'.$balance],
        ],[
                'amount.max' => 'The amount must be less than or equal to your balance: '.$balance." BDT",
        ]);
        $data = WalletData::from($request->all());
        $wallet = $this->wallet;
        return backWithError(function() use ($data, $wallet) {
            $wallet->withdraw($data);
        });
    }
}