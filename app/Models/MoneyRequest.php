<?php

namespace App\Models;

use App\Enum\Status;
use App\Traits\CanSendMoneyRequestNotification;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MoneyRequest extends Model
{
    use HasUuid;
    use CanSendMoneyRequestNotification;
    protected $casts = [
        'duration' => 'array',
        'accepted_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'release_requested_at' => 'datetime',
        'released_at' => 'datetime',
        'rejected_at' => 'datetime',
        'expires_at' => 'datetime',
        'reported_at' => 'datetime',
    ];

    public function getStatusAttribute(): string
    {
        if ($this->cancelled_at) {
            return Status::CANCELLED->value;
        }
        if ($this->released_at) {
            return Status::RELEASED->value;
        }
        if ($this->release_requested_at) {
            return Status::WAITING_FOR_RELEASE->value;
        }
        if ($this->rejected_at) {
            return Status::REJECTED->value;
        }
        if ($this->reported_at && $this->release_requested_at == null) {
            if ($this->reported_by === $this->receiver_id) {
                return Status::LOCKED->value;
            }
        }

        if ($this->accepted_at) {
            return Status::ACCEPTED->value;
        }
        return Status::PENDING->value;
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function reportedBy(): HasOne
    {
        return $this->hasOne(User::class, 'reported_by');
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Wallet::class, 'money_request_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_id');
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function from(): BelongsTo
    {
        if ($this->sender_id == auth()->id()) {
            return $this->receiver();
        } else {
            return $this->sender();
        }
    }
}
