<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Models\Message;
use App\Models\MoneyRequest;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;
use Spatie\LaravelData\Data;

/**
 * @typescript
 */
class ChatData extends Data
{
    use TimestampData;

    public int $id;
    public string $uuid;
    public bool $is_read;
    public bool $is_notified;
    public bool $is_archived;
    public bool $is_pinned;
    #[TypeScriptOptional]
    public ?MessageData $last_message;
    #[TypeScriptOptional]
    public ?UserData $from;
    #[TypeScriptOptional]
    public ?UserData $sender;
    #[TypeScriptOptional]
    public ?UserData $receiver;
    #[TypeScriptOptional]
    public ?array $typing;
    #[TypeScriptOptional]
    public $is_typing = false;

    public function __construct(
        public int $sender_id,
        public int $receiver_id
    ) {}
}
