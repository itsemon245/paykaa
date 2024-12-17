<?php

namespace App\Traits;

use App\Models\Scopes\OwnerScope;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOwner
{
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    protected static function bootHasOwner()
    {
        static::creating(function (Model $model) {
            /**
             * @var int|string $ownerId ID of the `User` who is creating the model\
             * If `auth()` is not found during console execution then it will try to take it from route param\
             */
            $owner = auth()->user();
            $ownerId = $owner?->id ?? 1;

            $model->owner_id = $model->owner_id ?? $ownerId;
        });

        static::addGlobalScope(new OwnerScope());
    }
}
