<?php

namespace App\Traits;

use App\Models\Scopes\LatestScope;

/**
 * The model will inherit some handy base queries that every model should have\
 * For example: latest().
 */
trait HasLatestScope {
    /**
     * The "booted" method of the model.
     */
    protected static function bootHasBaseQueries() {
        static::addGlobalScope(new LatestScope);
    }
}
