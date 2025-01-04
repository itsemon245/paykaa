<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Enum\AddType;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\LessThan;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/** @typescript */
class AddData extends Data
{
    use TimestampData;

    #[Nullable]
    public ?int $id;
    #[Nullable]
    public ?string $uuid;
    #[Optional]
    public ?UserData $owner;
    #[Optional]
    public ?AddMethodData $addMethod;
    public function __construct(
        #[Optional, Required]
        public AddType $type,
        #[Exists('users', 'id')]
        public int $owner_id,
        #[Optional, Required, Exists('add_methods', 'id')]
        public int $add_method_id,
        public ?string $contact,
        #[Min(1), Required]
        public float $amount,
        #[Min(1), Required]
        public float $rate,
        #[Optional, GreaterThan(field: 'limit_min'), Required]
        public int $limit_max,
        #[Optional, LessThan(field: 'limit_max'), Required]
        public int $limit_min,
    ) {}

    public static function messages(){
        return [
            'add_method_id.required' => 'Wallet is required',
            'limit_min.greater_than' => 'Limit min must be greater than limit max',
            'limit_max.less_than' => 'Limit max must be less than limit min',
        ];
    }

}
