<?php

namespace App\Models;


class Notification extends Model
{
    protected $casts = [
        'data' => 'array',
    ];
}
