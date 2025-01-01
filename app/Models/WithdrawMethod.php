<?php

namespace App\Models;

use App\Casts\Json;
use App\Traits\HasUuid;


class WithdrawMethod extends Model
{
    use HasUuid;

    protected $casts = [
        'fields' => 'array',
    ];
}
