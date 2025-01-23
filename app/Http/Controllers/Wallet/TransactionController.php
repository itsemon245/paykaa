<?php

namespace App\Http\Controllers\Wallet;

use App\Data\WalletData;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
    {
        $perPage = request()->query('per_page', 15);
        $transactions = Wallet::with(['depositMethod', 'withdrawMethod'])->paginate($perPage);
        return Inertia::render('Wallet/Transactions', [
            'transactions' => WalletData::collect($transactions)
        ]);
    }
}
