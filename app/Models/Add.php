<?php

namespace App\Models;

use App\Traits\HasOwner;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Add extends Model
{
    /** @use HasFactory<\Database\Factories\AddFactory> */
    use HasFactory;
    use HasOwner;
    use HasUuid;

    public function addMethod(): BelongsTo
    {
        return $this->belongsTo(AddMethod::class);
    }
}
