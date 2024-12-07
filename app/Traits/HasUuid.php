<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait HasUuid {
    public function getRouteKeyName() {
        return 'uuid';
    }
    protected static function bootHasUuid(): void {
        static::creating(function (Model $model) {
            $uuid = $model->uuid ?? Uuid::uuid7()->toString();
            $model->uuid = $uuid;
        });
    }
}
