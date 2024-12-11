<?php

namespace App\Models;

use App\Traits\HasUuid;

class Chat extends Model
{
    use HasUuid;

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function lastMessage()
    {
        return $this->messages()->one();
    }
}
