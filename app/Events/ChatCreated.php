<?php

namespace App\Events;

use App\Data\ChatData;
use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $chat;
    public $authId;

    /**
     * Create a new event instance.
     */
    public function __construct(Chat $chat, int $authId)
    {
        $chat->loadMissing('sender', 'receiver', 'lastMessage');
        $this->chat = ChatData::from($chat);
        //Think of it in the receiver's perspective
        if ($chat->sender_id === $authId) {
            $this->authId = $chat->receiver_id;
        } else {
            $this->authId = $chat->sender_id;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('new-chat.' . $this->authId),
        ];
    }
}
