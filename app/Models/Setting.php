<?php

namespace App\Models;


class Setting extends Model
{
    protected $casts = [
        'transactions' => 'array',
        'general' => 'array',
    ];
}
