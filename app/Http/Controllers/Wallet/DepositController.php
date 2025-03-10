<?php

namespace App\Http\Controllers\Wallet;

use App\Data\DepositMethodData;
use App\Data\WalletData;
use App\Http\Controllers\Controller;
use App\Models\DepositMethod;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wallet;
use App\Services\Wallet as WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class DepositController extends Controller
{
    public function __construct(
        private WalletService $wallet
    ) {}
    public function index()
    {
        $perPage = request()->query('per_page', 15);
        $deposits = Wallet::deposits()->pending()->paginate($perPage);
        $depositMethods = DepositMethod::all();
        return Inertia::render('Wallet/Deposit', [
            'deposits' => WalletData::collect($deposits),
            'depositMethods' => DepositMethodData::collect($depositMethods)
        ]);
    }
    public function store(Request $request)
    {
        $minDepositAmount = Setting::first()->transactions['min_deposit_amount'];
        if ($minDepositAmount && $request->amount <= $minDepositAmount) {
            $validator = Validator::make($request->all(), [
                'amount' => 'required'
            ]);
            $validator->after(function ($validator) use ($minDepositAmount) {
                $validator->errors()->add('amount', 'Amount must be greater than or equal to ' . $minDepositAmount);
            });
            $validator->validate();
        }
        $data = WalletData::from($request);
        $wallet = $this->wallet;
        return backWithError(function () use ($data, $wallet) {
            $newWallet = $wallet->deposit($data);
            return back();
        });
    }

    public function checkBalance(User $user = null)
    {
        return response()->json([
            'balance' => Wallet::getBalance($user)
        ]);
    }
}
