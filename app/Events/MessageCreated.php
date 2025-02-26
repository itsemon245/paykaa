<?php

namespace App\Events;

use App\Data\MessageData;
use App\Enum\MessageType;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MoneyReqeuestNotification;
use App\Events\MoneyRequestUpdated;
use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class MessageCreated implements ShouldBroadcast, ShouldQueueAfterCommit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public MessageData $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $message->loadMissing('chat', 'sender', 'receiver');
        if ($message->type == MessageType::MoneyRequest->value) {
            $message->loadMissing('moneyRequest');
            $message->loadMissing('moneyRequest.from');
            $message->update([
                'created_at' => now(),
            ]);
            Log::info("Sending MoneyRequest Notification: ", $message->moneyRequest->toArray());
            $notification = Notification::where([
                'type' => MoneyReqeuestNotification::class,
                'notifiable_id' => $message->receiver_id,
                'data->moneyRequest->uuid' => $message->moneyRequest->uuid,
            ])->first();
            if (!$notification) {
                $notification = Notification::create([
                    'id' => Uuid::uuid7()->toString(),
                    'notifiable_type' => User::class,
                    'notifiable_id' => $message->receiver_id,
                    'type' => MoneyReqeuestNotification::class,
                    'data' => [
                        'moneyRequest' => $message->moneyRequest->toArray(),
                    ],
                    'read_at' => null,
                ]);
            } else {
                $notification = tap($notification)->update([
                    'data' => [
                        ...$notification->data,
                        'moneyRequest' => $message->moneyRequest->toArray(),
                    ],
                    'read_at' => null,
                ]);
            }
            Log::info("Notification: ", $notification->toArray());
            if ($notification) {
                event(new MoneyRequestUpdated($notification));
            }
        }
        $message->chat->update([
            'last_message_at' => now(),
        ]);
        $this->message = MessageData::from($message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->message->chat_id),
        ];
    }
}
