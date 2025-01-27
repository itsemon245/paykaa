<?php

namespace App\Http\Controllers;

use App\Data\ChatData;
use App\Data\MessageData;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use http\Client\Response;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Chat/Index');
    }
    public function getUserChats()
    {
        $chats = Chat::with('lastMessage', 'sender', 'receiver')->where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->id())->paginate();
        return response()->json(ChatData::collect($chats));
    }

    public function checkNewMessages(Request $request)
    {
        $chat = Chat::where('uuid', $request->chat)->with('lastMessage', 'sender', 'receiver')->first();
        $updateCount = Chat::where('receiver_id', auth()->id())
            ->where('is_notified', false)
            ->update(['is_notified' => true]);
        return response()->json([
            'success' => $updateCount > 0,
            'chat' => $chat ? ChatData::from($chat) : null,
        ]);
    }

    public function show(Chat $chat)
    {
        $chat->messages()->received()->unread()->update(['is_read' => true]);
        $chat->loadMissing('sender', 'receiver', 'lastMessage');
        return Inertia::render('Chat/Show', [
            'chat' => ChatData::from($chat),
            'messages' => MessageData::collect($chat->messages()->with('moneyRequest', 'sender', 'receiver')->paginate()),
        ]);
    }
    public function typing(Request $request, Chat $chat)
    {
        if (auth()->id() !== $chat->sender_id) {
            if (auth()->id() !== $chat->receiver_id) {
                return response()->json([
                    'message' => 'You are not allowed to do this action in this chat',
                ], 403);
            }
        }
        $oldIndex = collect($chat->typing ?? [])->search(auth()->user()->uuid);
        $newTyping = collect($chat->typing ?? []);
        if ($request->is_typing === '1' && $oldIndex === false) {
            $newTyping->push(auth()->user()->uuid);
        }
        if ($request->is_typing === '0' && $oldIndex !== false) {
            $newTyping->splice($oldIndex, 1);
        }
        $chat->update([
            'typing' => $newTyping->toArray(),
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function receiverChat(User $receiver)
    {
        $chat = Chat::where('receiver_id', $receiver->id)->where('sender_id', auth()->user()->id)->first();
        if (!$chat) {
            $chat = Chat::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $receiver->id,
            ]);
        }
        return redirect()->route('chat.show', ['chat' => $chat->uuid]);
    }
}
