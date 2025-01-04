<?php

namespace App\Data;
use App\Data\Partials\TimestampData;
use App\Enum\Wallet\WalletStatus;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

/**
* @typescript
*/
class WalletData extends Data
{
    use TimestampData;

    public ?int $id;
    public ?string $uuid;
    public ?int $owner_id;
    public ?UserData $owner;
    public ?WalletStatus $status;
    public function __construct(
        public WalletType $type,
        public WalletTransactionType $transaction_type,
        public float $amount,
        #[Optional]
        public ?int $deposit_method_id,
        #[Optional]
        public ?int $withdraw_method_id,
        #[Optional]
        /** @var AdditionalFields[] */
        public ?array $additional_fields,
        public ?string $currency = 'bdt',
        #[Optional]
        public ?float $commission = 0,
        #[Optional]
        public ?string $method,
        #[Optional]
        public ?string $transaction_id,
        #[Optional]
        public ?string $note,
        #[Optional]
        public ?string $receipt,
        #[Optional]
        public ?string $payment_number,
        #[Optional]
        public ?Carbon $approved_at,
        #[Optional]
        public ?Carbon $cancelled_at,
        #[Optional]
        public ?Carbon $failed_at,
    ) {
    }
}
