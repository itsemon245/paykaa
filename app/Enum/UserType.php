<?php

namespace App\Enum;

enum UserType: string
{
    case Customer = 'customer';
    case Admin = 'admin';
}

