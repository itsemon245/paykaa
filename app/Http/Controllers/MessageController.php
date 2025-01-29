<?php

namespace App\Http\Controllers;

use App\Data\ChatData;
use App\Data\MessageData;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function checkNewMessages(Chat $chat)
    {
        $messageCount = $chat->messages()->received()->where('is_read', false)->update([
            'is_read' => true
        ]);
        $chat->loadMissing('sender', 'receiver', 'lastMessage');
        $chat->refresh();
        return response()->json([
            'success' => $messageCount > 0,
            'count' => $messageCount,
            'chat' => ChatData::from($chat),
        ]);
    }
    public function getNewMessages(Chat $chat)
    {
        $updated = $chat->messages()->received()->where('is_read', false)->update([
            'is_read' => true
        ]);
        $messages = $chat->messages()->paginate();
        return response()->json([
            'messages' => MessageData::collect($messages)
        ]);
    }
    public function store(Chat $chat, Request $request)
    {
        $messageData = MessageData::from($request->all());
        $message = Message::create([
            ...$messageData->only('chat_id', 'sender_id', 'receiver_id', 'type', 'body')->toArray(),
        ]);
        return back();
    }

    public function moneyRequestMessages(Chat $chat)
    {
        $messages = $chat->messages()->whereHas('moneyRequest')
            ->with('moneyRequest', 'sender', 'receiver', 'moneyRequest', 'moneyRequest.from')
            ->paginate();
        return response()->json([
            'messages' => MessageData::collect($messages)
        ]);
    }
}
