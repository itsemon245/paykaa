<?php

namespace App\Data;

use App\Enum\InputType;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/**
* @typescript
*/
class FieldsData extends Data{
    public function __construct(
        public string $name,
        public string $label,
        #[Optional]
        public ?InputType $type = InputType::TEXT->value,
        #[Optional]
        public ?string $placeholder,
        public bool $required = true,
    ) {
    }
}
