<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Enum\Status;
use Carbon\Carbon;
use DateTime;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/**
 * @typescript
 */
class MoneyRequestData extends Data
{
    use TimestampData;

    #[Optional]
    public ?string $uuid;
    #[Optional]
    public MessageData $message;
    #[Optional]
    public ?UserData $from;
    public Status $status;
    public function __construct(
        public int $sender_id,
        public int $receiver_id,
        public int $message_id,
        public int $amount,
        #[Optional]
        public ?DurationData $duration,
        #[Optional]
        public ?string $currency,
        #[Optional]
        public ?string $note,
        #[Optional]
        public ?Carbon $accepted_at,
        #[Optional]
        public ?Carbon $cancelled_at,
        #[Optional]
        public ?Carbon $release_requested_at,
        #[Optional]
        public ?Carbon $released_at,
        #[Optional]
        public ?Carbon $rejected_at,
        #[Optional]
        public ?Carbon $expires_at,
    ) {}
}
