<?php

namespace App\Data;
use App\Data\Partials\TimestampData;
use App\Enum\MessageType;
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
    public ChatData $chat;
    public bool $by_me;
    public function __construct(
        public int $chat_id,
        public int $sender_id,
        public int $receiver_id,
        public MessageType $type,
        public string $body,
    ) {
        $this->type = $type ?? MessageType::Text->value;
        $this->by_me = $sender_id === auth()->user()->id;
    }
}
