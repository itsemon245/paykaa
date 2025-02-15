<?php

namespace App\Enum;

enum EarningStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case CONVERTED = 'converted';
}
