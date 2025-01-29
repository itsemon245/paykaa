<?php

namespace App\Enum\Wallet;

enum WalletTransactionType: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case TRANSFER = 'transfer';
    case EARN = 'earn';
}
