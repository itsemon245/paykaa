<?php

namespace App\Enum\Wallet;

enum WalletStatus : string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
}
