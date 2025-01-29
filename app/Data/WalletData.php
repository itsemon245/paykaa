<?php

namespace App\Data;

use App\Data\Partials\TimestampData;
use App\Enum\MethodCategory;
use App\Enum\Wallet\WalletStatus;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use Carbon\Carbon;
use Illuminate\Validation\Validator;
use Spatie\LaravelData\Attributes\Validation\Min;
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
    public ?UserData $user;
    public ?WalletStatus $status;
    public ?DepositMethodData $depositMethod;
    public ?WithdrawMethodData $withdrawMethod;
    public function __construct(
        public WalletType $type,
        public WalletTransactionType $transaction_type,
        #[Min(1)]
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
        public ?string $account_holder,
        #[Optional]
        public ?Carbon $approved_at,
        #[Optional]
        public ?Carbon $cancelled_at,
        #[Optional]
        public ?Carbon $failed_at,
    ) {}

    public static function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $request = request();
            if ($request->method === MethodCategory::MOBILE_BANKING->value && $request->transaction_type === WalletTransactionType::DEPOSIT->value) {
                if (!$request->payment_number) {
                    $validator->errors()->add('payment_number', 'Number is required');
                }
                if (!$request->transaction_id) {
                    $validator->errors()->add('transaction_id', 'Transaction ID is required');
                }
            }

            if ($request->method === MethodCategory::BANK->value && $request->transaction_type === WalletTransactionType::DEPOSIT->value) {
                if (!$request->account_holder) {
                    $validator->errors()->add('account_holder', 'A/c Name is required');
                }
                if (!$request->payment_number) {
                    $validator->errors()->add('payment_number', 'A/c Number is required');
                }
            }
        });
    }
}
