<?php

namespace App\Enum;

enum MessageType: string
{
    case Text = 'text';
    case Image = 'image';
    case MoneyRequest = 'money_request';
}
