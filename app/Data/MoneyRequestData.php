<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use Carbon\Carbon;
use DateTime;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/**
 * @typescript
 */
class MoneyRequestData extends Data
{
    use TimestampData;

    #[Optional]
    public MessageData $message;
    #[Optional]
    public UserData $from;
    public function __construct(
        public int $sender_id,
        public int $receiver_id,
        public int $message_id,
        public int $amount,
        #[Optional]
        public ?string $currency,
        #[Optional]
        public ?string $note,
        #[Optional]
        public ?DateTime $accepted_at,
        #[Optional]
        public ?DateTime $released_at,
        #[Optional]
        public ?DateTime $rejected_at,
    ) {}
}
