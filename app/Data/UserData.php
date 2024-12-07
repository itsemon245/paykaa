<?php

namespace App\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;
use App\Enum\UserType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

/**
* @typescript
*/
class UserData extends Data
{
    public int $id;
    #[TypeScriptOptional]
    public ?string $referral_id;
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
