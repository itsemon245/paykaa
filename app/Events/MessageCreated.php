<?php

namespace App\Events;

use App\Data\MessageData;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public MessageData $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $message->loadMissing('chat', 'sender', 'receiver', 'moneyRequest');
        $message->chat->update([
            'last_message_at' => now(),
        ]);
        $this->message = MessageData::from($message);
        $this->message->by_me = false;
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
