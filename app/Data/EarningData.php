<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Enum\AddType;
use App\Enum\EarningStatus;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\LessThan;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/** @typescript */
class EarningData extends Data
{
    use TimestampData;

    #[Nullable]
    public ?int $id;
    public int $user_id;
    #[Optional]
    public ?UserData $user;
    public int $from_id;
    #[Optional]
    public ?UserData $from;
    public float $amount;
    public EarningStatus $status;
    public function __construct() {}
}
