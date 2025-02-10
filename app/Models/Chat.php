<?php

namespace App\Models;

use App\Traits\HasUuid;

class Chat extends Model
{
    use HasUuid;
    protected $casts = [
        'typing' => 'array',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function getIsTypingAttribute()
    {
        $isTyping = collect($this->typing ?? [])->contains($this->from?->uuid);
        // dd($isTyping, $this->typing, $this->from?->uuid);
        return $isTyping;
    }
    public function getFromAttribute()
    {
        if ($this->sender_id == auth()->id()) {
            return $this->receiver;
        } else {
            return $this->sender;
        }
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function lastMessage()
    {
        return $this->messages()->latest()->one();
    }
}
