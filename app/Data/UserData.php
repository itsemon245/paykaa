<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;
use App\Enum\UserType;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

/**
 * @typescript
 */
class UserData extends Data
{
    use TimestampData;

    public int $id;
    public string $uuid;
    #[TypeScriptOptional]
    public ?string $referral_id;
    #[TypeScriptOptional]
    public ?float $balance;
    #[TypeScriptOptional]
    public ?string $email_verified_at;
    #[TypeScriptOptional]
    public string | bool $active_status = false;
    public function __construct(
        public string $name,
        public string $email,
        #[TypeScriptOptional]
        public ?string $avatar,
        #[TypeScriptOptional]
        public ?string $phone,
        #[TypeScriptOptional]
        public ?UserType $type,
        #[TypeScriptOptional]
        public ?string $gender,
        #[TypeScriptOptional]
        public ?string $date_of_birth,
        #[TypeScriptOptional]
        public ?string $country,
        #[TypeScriptOptional]
        public ?string $address,
        #[TypeScriptOptional]
        public ?string $password,
    ) {
        $this->type = $type ?? UserType::Customer->value;
        $this->avatar = $avatar ?? avatar($this->name);
    }
}
