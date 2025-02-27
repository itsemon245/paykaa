<?php

namespace App\Traits;

use App\Data\MoneyRequestData;
use App\Events\MoneyRequestUpdated;
use App\Models\MoneyRequest;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\MoneyReqeuestNotification;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

trait CanSendMoneyRequestNotification
{
    protected static function bootCanSendMoneyRequestNotification()
    {
        static::created(function (MoneyRequest $moneyRequest) {
            $moneyRequest->loadMissing('from');
            $moneyRequestData = MoneyRequestData::from($moneyRequest);
            $notification = self::createNotification($moneyRequest, $moneyRequestData);
            Log::info("Sending MoneyRequest Notification: ", $notification->toArray());
            // event(new MoneyRequestUpdated($notification->id));
        });

        static::updated(function (MoneyRequest $moneyRequest) {
            $moneyRequest->loadMissing('from');
            $moneyRequestData = MoneyRequestData::from($moneyRequest);
            $notification = Notification::where([
                'type' => MoneyReqeuestNotification::class,
                'notifiable_id' => $moneyRequest->receiver_id,
                'data->moneyRequest->uuid' => $moneyRequest->uuid,
            ])->first();

            if (!$notification) {
                $notification = self::createNotification($moneyRequest, $moneyRequestData);
            } else {
                Log::info("Updating MoneyRequest Notification: ", $moneyRequestData->toArray());
                $notification = tap($notification)->update([
                    'data' => [
                        ...$notification->data,
                        'moneyRequest' => $moneyRequestData->toArray(),
                    ],
                    'read_at' => null,
                ]);
            }
            // event(new MoneyRequestUpdated($notification->id));
        });
    }

    protected static function createNotification(MoneyRequest $moneyRequest, MoneyRequestData $moneyRequestData): Notification
    {
        return Notification::create([
            'id' => Uuid::uuid7()->toString(),
            'notifiable_type' => User::class,
            'notifiable_id' => $moneyRequest->receiver_id,
            'type' => MoneyReqeuestNotification::class,
            'data' => [
                'moneyRequest' => $moneyRequestData->toArray(),
            ],
            'read_at' => null,
        ]);
    }
}
