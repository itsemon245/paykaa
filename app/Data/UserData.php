<?php

namespace App\Data;
use App\Data\Partials\TimestampData;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;
use App\Enum\UserType;
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
    public string|null $email_verified_at;
    public function __construct(
        public string $name,
        public string $email,
        public string $username,
        #[TypeScriptOptional]
        public ?string $avatar,
        #[TypeScriptOptional]
        public ?string $phone,
        #[TypeScriptOptional]
        public ?UserType $type,
    ) {
        $this->type = $type ?? UserType::Customer->value;
        $this->avatar = $avatar ?? avatar($this->name);
    }
}
