<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/** @typescript */
class AddMethodData extends Data{
    use TimestampData;
    public int $id;
    public function __construct(
        public string $name,
        #[Optional]
        public ?string $logo,
        #[Optional]
        public ?string $color,
    ) {}
}
