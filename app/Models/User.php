<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\UserType;
use App\Models\Wallet;
use App\Traits\HasLatestScope;
use App\Traits\HasUuid;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasUuid;
    use Notifiable;


    public function isAdmin(): bool
    {
        return $this->id == 1 || $this->type === UserType::Admin->value;
    }
    public function referrals(): HasMany
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function phoneHistory(): HasMany
    {
        return $this->hasMany(PhoneHistory::class);
    }

    public function referer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function kyc()
    {
        return $this->hasOne(Kyc::class);
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    public function setActiveNow()
    {
        $this->update([
            'last_seen_at' => now()
        ]);
    }

    /**
     * @return float
     */
    public function getBalanceAttribute(): float
    {
        return Wallet::getBalance($this);
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $this->id === 1 ? asset('assets/favicon.png') : ($value ? $value : avatar()),
        );
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
