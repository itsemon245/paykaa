<?php

namespace App\Http\Controllers\Wallet;

use App\Data\WalletData;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
    {
        $perPage = request()->query('per_page', 15);
        $transactions = Wallet::with(['depositMethod', 'withdrawMethod', 'owner', 'user'])->paginate($perPage);
        return Inertia::render('Wallet/Transactions', [
            'transactions' => WalletData::collect($transactions)
        ]);
    }

    public function sendMoneyVerifyPassword(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'password' => 'required',
        ]);
        $user = User::find(auth()->id());
        if ($user->balance < (float)$request->amount) {
            throw ValidationException::withMessages(['amount' => 'Insufficient balance']);
        }
        if (!Hash::check($request->password, $user->password)) {
            return Inertia::render('Dashboard/Index', ['error' => 'Invalid password!']);
        }
        return Inertia::render('Dashboard/Index', ['success' => 'Password verified!']);
    }
    public function sendMoneyStore(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'password' => 'required',
            'recipient' => 'required|exists:users,id',
        ]);
        $user = User::find(auth()->id());
        if ($user->balance < (float)$request->amount) {
            throw ValidationException::withMessages(['amount' => 'Insufficient balance']);
        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid password');
        }
        return backWithError(function () use ($request) {
            Wallet::create([
                'owner_id' => auth()->id(),
                'user_id' => $request->recipient,
                'transaction_type' => WalletTransactionType::TRANSFER->value,
                'type' => WalletType::DEBIT->value,
                'amount' => $request->amount,
                'currency' => 'bdt',
                'approved_at' => now(),
                'transaction_id' => uniqid('TRXO-'),
                'note' => "Send money to user {$request->recipient}",
            ]);
            $wallet = Wallet::create([
                'owner_id' => $request->recipient,
                'user_id' => auth()->id(),
                'transaction_type' => WalletTransactionType::TRANSFER->value,
                'type' => WalletType::CREDIT->value,
                'amount' => $request->amount,
                'currency' => 'bdt',
                'approved_at' => now(),
                'transaction_id' => uniqid('TRXI-'),
                'note' => "Received money from user " . auth()->id(),
            ]);
            return Inertia::render('Dashboard/Index', ['transaction' => WalletData::from($wallet)]);
        });
    }
}
