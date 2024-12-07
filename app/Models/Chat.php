<?php

namespace App\Models;

use App\Traits\HasUuid;

class Chat extends Model
{
    use HasUuid;

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    public function lastMessage(): HasOne
    {
        return $this->messages()->one();
    }
}
