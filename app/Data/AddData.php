<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Enum\AddType;
use Illuminate\Validation\Validator;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\LessThan;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\RequiredIf;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
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
        #[Min(10), Required]
        public float $amount,
        public ?float $rate,
        #[Optional]
        public ?int $limit_max,
        #[Optional]
        public ?int $limit_min,
    ) {}

    public static function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $request = request();
            if ($request->type === AddType::SELL->value) {
                if (!$request->rate) {
                    $validator->errors()->add('rate', 'Rate is required');
                }
                if (!$request->limit_min) {
                    $validator->errors()->add('limit_min', 'Limit min is required');
                }
                if (!$request->limit_max) {
                    $validator->errors()->add('limit_max', 'Limit max is required');
                }
                if ($request->limit_min > $request->limit_max) {
                    $validator->errors()->add('limit_min', 'Limit min must be less than limit max');
                }
            }
        });
    }

    public static function messages()
    {
        return [
            'add_method_id.required' => 'Wallet is required',
            'limit_min.greater_than' => 'Limit min must be greater than limit max',
            'limit_max.less_than' => 'Limit max must be less than limit min',
        ];
    }
}
