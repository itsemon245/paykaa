<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/**
* @typescript
*/
class AdditionalFields extends Data{
    public function __construct(
        public string $name,
        #[Optional]
        public ?string $value,
    ) {
    }
}
