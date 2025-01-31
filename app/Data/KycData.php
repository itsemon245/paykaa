<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Enum\KycDocType;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/** @typescript */
class KycData extends Data
{
    use TimestampData;
    public function __construct(
        #[Optional]
        public ?KycDocType $doc_type,
        public string $front_image,
        public string $back_image,
        #[Optional]
        public ?Carbon $approved_at,
        #[Optional]
        public ?Carbon $rejected_at,
    ) {}
}
