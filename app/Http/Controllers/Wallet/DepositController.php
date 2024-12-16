<?php

namespace App\Http\Controllers\Wallet;

use App\Data\WalletData;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Services\Wallet as WalletService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepositController extends Controller
{
    public function __construct(
        private WalletService $wallet
    ) {
    }
    public function index()
    {
        $perPage = request()->query('per_page', 15);
        $deposits = Wallet::deposits()->paginate($perPage);
        return Inertia::render('Wallet/Deposit', [
            'deposits'=> WalletData::collect($deposits)
        ]);
    }
    public function store(Request $request)
    {
        $data = WalletData::from($request->all());
        $wallet = $this->wallet;
        return backWithError(function() use ($data, $wallet) {
            $wallet->deposit($data);
        });
    }
}
