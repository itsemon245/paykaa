<?php

namespace App\Models;

use App\Enum\Wallet\WalletStatus;
use App\Traits\HasUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enum\Wallet\WalletTransactionType;

class Wallet extends Model
{
    use HasFactory;
    use HasUuid;
    protected $table = 'wallet';

    /**
     * @return BelongsTo
     */
    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute(): string
    {
        if($this->failed_at) {
            return WalletStatus::FAILED->value;
        }
        if($this->cancelled_at) {
            return WalletStatus::CANCELLED->value;
        }
        if($this->approved_at) {
            return WalletStatus::APPROVED->value;
        }
        return WalletStatus::PENDING->value;
    }

    public function scopeDeposits(Builder $query): Builder
    {
        return $query->where('transaction_type', WalletTransactionType::DEPOSIT->value);
    }
    public function scopeWithdrawals(Builder $query): Builder
    {
        return $query->where('transaction_type', WalletTransactionType::WITHDRAW->value);
    }
}
