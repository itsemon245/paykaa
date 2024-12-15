<?php

namespace App\Enum\Wallet;

enum WalletStatus : string
{
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const APPROVED = 'approved';
    const FAILED = 'failed';
}
