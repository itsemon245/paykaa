<?php

namespace App\Events;

use App\Data\MessageData;
use App\Data\MoneyRequestData;
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
    public int $authId;

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
        }
        $message->chat->update([
            'last_message_at' => now(),
        ]);
        $this->message = MessageData::from($message);
        $this->authId = auth()->id();
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
