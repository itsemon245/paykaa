<?php

namespace App\Data;

use Spatie\LaravelData\Data;

/**
 * @typescript
 */
class DurationData extends Data
{
    public function __construct(
        public int $day,
        public int $hour,
        public int $minute,
    ) {}
}
