<?php

namespace App\Enum\Wallet;

enum WalletRemark: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case TRANSFER_IN = 'transfer_in';
    case TRANSFER_OUT = 'transfer_out';
    case EARN = 'earn';
    case SERVICE_CHARGE = 'service_charge';
}
