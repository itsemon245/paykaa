<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepositMethod extends Model
{
    /** @use HasFactory<\Database\Factories\DepositMethodFactory> */
    use HasFactory;
    use HasUuid;

    protected $casts = [
        'secrets' => 'array',
        'metadata' => 'array',
    ];
}
