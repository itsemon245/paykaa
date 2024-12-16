<?php

namespace App\Enum\Wallet;

enum WalletType: string
{
    case DEBIT = 'debit';
    case CREDIT = 'credit';
}
