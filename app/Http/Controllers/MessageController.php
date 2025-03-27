<?php

namespace App\Http\Controllers;

use App\Data\ChatData;
use App\Data\MessageData;
use App\Enum\MessageType;
use App\Events\ChatCreated;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Setting;
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
            $now = now();

            $chat->loadMissing('lastMessage');
            if ($request->get('body')) {
                $message = Message::create([
                    ...$messageData->only('chat_id', 'sender_id', 'receiver_id', 'type', 'body', 'replied_to')->toArray(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
            if (!$chat->lastMessage) {
                event(new ChatCreated($chat, auth()->id()));

                $instantReply = Setting::select('general')?->first()?->general['instant_reply'] ?? null;
                if ($messageData->receiver_id === 1 && $instantReply) {
                    Message::create([
                        'chat_id' => $chat->id,
                        'sender_id' => 1,
                        'receiver_id' => auth()->id(),
                        'type' => MessageType::Text->value,
                        'body' => $instantReply,
                        'created_at' => $now->addSeconds(3),
                        'updated_at' => $now->addSeconds(3),
                    ]);
                }
            }

            if ($request->image) {
                $path = $request->file('image')->store('messages', 'public');
                $message = Message::create([
                    ...$messageData->only('chat_id', 'sender_id', 'receiver_id')->toArray(),
                    'body' => $path,
                    'type' => 'image',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
            event(new \App\Events\MessageCreated($message));
            return back();
        });
    }

    public function moneyRequestMessages(Chat $chat)
    {
        //only show pending money requests
        $messages = $chat->messages()->whereHas('moneyRequest', function ($query) {
            // $query->where('released_at', null)
            //     ->where('rejected_at', null)
            //     ->where('cancelled_at', null);
        })
            ->with('sender', 'receiver', 'moneyRequest', 'from', 'moneyRequest.from', 'ogMoneyRequest', 'ogMoneyRequest.from')
            ->limit(1)
            ->paginate();
        return response()->json([
            'messages' => MessageData::collect($messages)
        ]);
    }
}
