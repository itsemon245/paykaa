<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasUuid;

    protected $casts = [
        'data' => 'array',
    ];

    public function parent()
    {
        return $this->belongsTo(Message::class, 'replied_to');
    }

    public function ogMoneyRequest()
    {
        return $this->belongsTo(MoneyRequest::class, 'og_money_request_id');
    }

    public function getByMeAttribute()
    {
        return $this->sender_id === auth()->id();
    }

    public function scopeReceived($query)
    {
        return $query->where('receiver_id', auth()->id());
    }

    public function scopeSent($query)
    {
        return $query->where('sender_id', auth()->id());
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', 1);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function from(): BelongsTo
    {
        if ($this->sender_id == auth()->id()) {
            return $this->receiver();
        }
        return $this->sender();
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function moneyRequest(): HasOne
    {
        return $this->hasOne(MoneyRequest::class);
    }
}
