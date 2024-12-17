<?php

namespace App\Services;

use App\Data\WalletData;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Models\Wallet as WalletModel;

class Wallet {
    public function deposit(WalletData $data) {
        return WalletModel::create([
            ...$data->toArray(),
            'transaction_type'=> WalletTransactionType::DEPOSIT->value,
            'type'=> WalletType::CREDIT->value,
            'commission'=> config('app.payment.is_fixed_amount') ? config('app.payment.charge') : $data->amount * (config('app.payment.charge') / 100),
        ]);
    }
}
