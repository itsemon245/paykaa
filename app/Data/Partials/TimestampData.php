<?php

namespace App\Data\Partials;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Computed;

trait TimestampData
{
    public Carbon $created_at;
    public Carbon $updated_at;
    public string $created_at_human;
    public string $updated_at_human;
}
