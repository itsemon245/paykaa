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
        #[Optional]
        public ?MethodMode $mode,
        #[Optional]
        public ?string $number,
        #[Optional]
        public ?string $bank_name,
        #[Optional]
        public ?string $account_holder,
        #[Optional]
        public ?string $branch_name,
        #[Optional]
        public ?string $swift_code,
        #[Optional]
        public ?string $routing_number,
        #[Optional]
        public ?string $description,
        #[Optional]
        public ?array $secrets,
        #[Optional]
        public ?array $metadata,
    ) {
    }
}
