<?php

namespace App\Enum;

enum MethodCategory: string
{
    case BANK = 'Bank';
    case CRYPTO = 'Cryptocurrency';
    case MOBILE_BANKING = 'Mobile Banking';
}
