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
    public function getUserChats() {
        $chats = Chat::with('lastMessage', 'sender', 'receiver')->where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->id())->paginate();
        return response()->json(ChatData::collect($chats));
    }

    public function checkNewMessages()
    {
        $updateCount = Chat::where('recevier_id', auth()->id())
            ->where('is_notified', false)
            ->update(['is_notified'=> true]);
        return response()->json([
            'success' => $updateCount > 0,
        ]);
    }

    public function show(Chat $chat)
    {
        $chat->messages()->received()->unread()->update(['is_read' => true]);
        $chat->loadMissing('sender', 'receiver', 'lastMessage');
        return Inertia::render('Chat/Show', [
            'chat' => ChatData::from($chat),
            'messages' => MessageData::collect($chat->messages()->paginate()),
        ]);
    }
    /**
     * Display the specified resource.
     */
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
