<?php

namespace App\Data\Partials;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\TypeScriptTransformer\Attributes\Optional;

trait TimestampData
{
    public Carbon $created_at;
    public Carbon $updated_at;
    #[Optional]
    public ?string $created_at_human;
    #[Optional]
    public ?string $updated_at_human;
}
