<?php

namespace App\Http\Controllers;

use App\Data\ChatData;
use App\Data\MessageData;
use App\Events\ChatCreated;
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
        return backWithError(function () use ($chat, $request) {
            $messageData = MessageData::from($request->all());

            if ($request->get('body')) {
                $message = Message::create([
                    ...$messageData->only('chat_id', 'sender_id', 'receiver_id', 'type', 'body')->toArray(),
                ]);
            }
            $chat->loadMissing('lastMessage');
            if (!$chat->lastMessage) {
                event(new ChatCreated($chat, auth()->id()));
            }
            if ($request->image) {
                $path = $request->file('image')->store('messages', 'public');
                $message = Message::create([
                    ...$messageData->only('chat_id', 'sender_id', 'receiver_id')->toArray(),
                    'body' => $path,
                    'type' => 'image',
                ]);
                event(new \App\Events\MessageCreated($message));
            }

            event(new \App\Events\MessageCreated($message));
            return back();
        });
    }

    public function moneyRequestMessages(Chat $chat)
    {
        //only show pending money requests
        $messages = $chat->messages()->whereHas('moneyRequest', function ($query) {
            $query->where('released_at', null)
                ->where('rejected_at', null)
                ->where('cancelled_at', null);
        })
            ->with('sender', 'receiver', 'moneyRequest', 'moneyRequest.from')
            ->paginate();
        return response()->json([
            'messages' => MessageData::collect($messages)
        ]);
    }
}
