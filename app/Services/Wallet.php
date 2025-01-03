<?php

namespace App\Services;

use App\Data\WalletData;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Models\Wallet as WalletModel;
use Illuminate\Support\Str;

class Wallet {
    public function deposit(WalletData $data) {
        return WalletModel::create([
            ...$data->toArray(),
            'transaction_type'=> WalletTransactionType::DEPOSIT->value,
            'type'=> WalletType::CREDIT->value,
            'commission'=> config('app.payment.is_fixed_amount') ? config('app.payment.charge') : $data->amount * (config('app.payment.charge') / 100),
        ]);
    }
    public function withdraw(WalletData $data) {
        dd($data->toArray());
        return WalletModel::create([
            ...$data->toArray(),
            'currency'=> 'bdt',
            'transaction_id'=> Str::random(10),
            'transaction_type'=> WalletTransactionType::WITHDRAW->value,
            'type'=> WalletType::DEBIT->value,
            'commission'=> 0
        ]);
    }
}
