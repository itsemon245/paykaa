<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Enum\MethodCategory;
use App\Enum\MethodMode;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/**
* @typescript
*/
class DepositMethodData extends Data
{
    use TimestampData;

    public int $id;
    public string $uuid;
    public function __construct(
        public string $label,
        public string $logo,
        public MethodCategory $category,
        public MethodMode $mode = MethodMode::MANUAL->value,
        public string $number,
        #[Optional]
        public ?string $description,
        #[Optional]
        public ?array $secrets,
        #[Optional]
        public ?DepositMethodMetaData $metadata,
    ) {
    }
}
