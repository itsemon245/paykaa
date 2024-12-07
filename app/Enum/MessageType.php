<?php

namespace App\Enum;

enum MessageType: string
{
    case Text = 'text';
    case MoneyRequest = 'money_request';
    case ReleaseRequest = 'release_request';
    case MoneyRequestAccepted = 'money_request_accepted';
    case ReleaseRequestAccepted = 'release_request_accepted';
}
