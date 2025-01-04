<?php

namespace App\Data;

use App\Enum\InputType;
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
        #[Optional]
        public ?string $label,
        #[Optional]
        public ?InputType $type,
    ) {
    }
}
