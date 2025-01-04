<?php

namespace App\Data\Partials;

use Carbon\Carbon;
use Spatie\TypeScriptTransformer\Attributes\Optional;

trait TimestampData
{
    #[Optional]
    public ?Carbon $created_at;
    #[Optional]
    public ?Carbon $updated_at;
    #[Optional]
    public ?string $created_at_human;
    #[Optional]
    public ?string $updated_at_human;
}
