<?php

namespace App\Services;

use App\Data\WalletData;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Models\Wallet as WalletModel;

class Wallet {
    public function deposit(WalletData $data, array $overrides = []) {
        return WalletModel::create([
            'type'=> WalletType::CREDIT->value,
            'amount'=> $data->amount,
            'transaction_id'=> $data->transaction_id,
            'transaction_type'=> WalletTransactionType::DEPOSIT->value,
            'payment_number'=> $data->payment_number,
            'note'=> $data->note,
            'user_id'=> auth()->user()->id,
            ...$overrides
        ]);
    }
}
