<?php

namespace App\Models;

use App\Enum\Wallet\WalletStatus;
use App\Traits\HasOwner;
use App\Traits\HasUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enum\Wallet\WalletTransactionType;

class Wallet extends Model
{
    use HasFactory;
    use HasUuid;
    use HasOwner;

    protected $table = 'wallet';
    protected $casts = [
        'additional_fields' => 'array',
        'approved_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'failed_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function withdrawMethod(): BelongsTo
    {
        return $this->belongsTo(WithdrawMethod::class, 'withdraw_method_id');
    }

    /**
     * @return BelongsTo
     */
    public function depositMethod(): BelongsTo
    {
        return $this->belongsTo(DepositMethod::class, 'deposit_method_id');
    }

    public function getStatusAttribute(): string
    {
        if ($this->failed_at) {
            return WalletStatus::FAILED->value;
        }
        if ($this->cancelled_at) {
            return WalletStatus::CANCELLED->value;
        }
        if ($this->approved_at) {
            return WalletStatus::APPROVED->value;
        }
        return WalletStatus::PENDING->value;
    }
    public static function getBalance(User $user = null): float
    {
        $balance = \DB::table('wallet')
            ->where('owner_id', $user?->id ?? auth()->id())
            ->whereNotNull('approved_at')
            ->selectRaw('SUM(CASE WHEN type = "credit" THEN amount ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN amount ELSE 0 END) AS balance')
            ->value('balance');
        return $balance ?? 0;
    }

    public function scopeDeposits(Builder $query): Builder
    {
        return $query->where('transaction_type', WalletTransactionType::DEPOSIT->value);
    }

    public function scopeWithdrawals(Builder $query): Builder
    {
        return $query->where('transaction_type', WalletTransactionType::WITHDRAW->value);
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->whereNotNull('approved_at');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->whereNull('approved_at');
    }
}
