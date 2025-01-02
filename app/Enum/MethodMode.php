<?php

namespace App\Enum;

enum MethodMode: string
{
    case PERSONAL = 'personal';
    case AGENT = 'agent';
    case PAYMENT = 'payment';
}
