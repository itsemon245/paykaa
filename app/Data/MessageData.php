<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Enum\MessageType;
use App\Models\MoneyRequest;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;
use Spatie\LaravelData\Data;

/**
 * @typescript
 */
class MessageData extends Data
{
    use TimestampData;

    public int $id;
    public string $uuid;
    #[TypeScriptOptional]
    public ChatData $chat;
    #[TypeScriptOptional]
    public MoneyRequestData $moneyRequest;
    #[Computed]
    public bool $by_me;
    public bool $is_read;
    #[TypeScriptOptional]
    public ?string $body;
    #[TypeScriptOptional]
    public ?UserData $from;
    #[TypeScriptOptional, Exists(table: 'messages', column: 'id')]
    public ?int $replied_to;
    #[TypeScriptOptional]
    public ?MessageData $parent;
    public function __construct(
        public int $chat_id,
        public int $sender_id,
        public int $receiver_id,
        public MessageType $type = MessageType::Text->value,
    ) {
        $this->by_me = $sender_id === auth()->user()->id;
        if (auth()->user()->isAdmin() && $this->sender_id === 1) {
            $this->is_read = true;
        }
    }
}
