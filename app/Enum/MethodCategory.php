<?php

namespace App\Enum;

enum MethodCategory: string
{
    case BANK = 'bank';
    case CRYPTO = 'crypto';
    case MOBILE_BANKING = 'mobile_banking';
}
