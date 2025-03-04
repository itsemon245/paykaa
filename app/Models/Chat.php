<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeMyChats(Builder $query, string|null $search = null): void
    {
        $query
            ->orderBy('last_message_at', 'desc')
            ->where(function (Builder $q) use ($search) {
                if ($search != auth()->user()?->id) {
                    $q->where('receiver_id', auth()->id());
                    $q->orWhere('sender_id', auth()->id());
                } else {
                    $q->where(function (Builder $builder) {
                        $builder->whereNot('receiver_id', auth()->id())->orWhereNot('sender_id', auth()->id());
                    });
                }
            })->where(function (Builder $q) use ($search) {
                if ($search) {
                    if ($search == 'unread') {
                        $q->where('is_read', false);
                    } else {
                        $q->where('sender_id', $search);
                        $q->orWhere('receiver_id', $search);
                    }
                }
            });
    }
    public function scopeWithEmpty(Builder $query): void
    {
        $query->orWhere(function (Builder $q) {
            $q->where('receiver_id', auth()->id())
                ->whereNotNull('last_message_at');
        });
    }
}
