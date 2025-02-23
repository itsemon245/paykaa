<?php

namespace App\Http\Controllers;

use App\Data\ChatData;
use App\Data\MessageData;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use http\Client\Response;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Chat/Index', [
            'chats' => $this->getChats($request),
        ]);
    }

    public function getUserChats(Request $request)
    {
        return response()->json($this->getChats($request));
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

    public function show(Request $request, Chat $chat)
    {
        $chat->messages()->received()->unread()->update(['is_read' => true]);
        $chat->update([
            'is_read' => true,
            'is_notified' => true
        ]);
        $chat->loadMissing('sender', 'receiver', 'lastMessage');

        return Inertia::render('Chat/Show', [
            'chat' => ChatData::from($chat),
            'chats' => $this->getChats($request),
            'messages' => MessageData::collect($chat
                ->messages()
                ->with('moneyRequest', 'sender', 'receiver', 'moneyRequest', 'moneyRequest.from')
                ->paginate()),
        ]);
    }

    public function helpline(Request $request)
    {
        $adminId = 1;
        $people = [auth()->user()->id, $adminId];
        $chat = Chat::whereIn('receiver_id', $people)->whereIn('sender_id', $people)->first();
        if (!$chat) {
            $chat = Chat::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $adminId,
            ]);
        }
        $chat->messages()->received()->unread()->update(['is_read' => true]);
        $chat->loadMissing('sender', 'receiver', 'lastMessage');

        return Inertia::render('Chat/Show', [
            'chat' => ChatData::from($chat),
            'chats' => $this->getChats($request, true),
            'helpline' => true,
            'messages' => MessageData::collect($chat
                ->messages()
                ->with('moneyRequest', 'sender', 'receiver', 'moneyRequest', 'moneyRequest.from')
                ->paginate()),
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
        $people = [auth()->user()->id, $receiver->id];
        $chat = Chat::whereIn('receiver_id', $people)->whereIn('sender_id', $people)->first();
        if (!$chat) {
            $chat = Chat::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $receiver->id,
            ]);
        }
        return redirect()->route('chat.show', ['chat' => $chat->uuid]);
    }

    public function getChats(Request $request, $helpline = false)
    {
        $chats = Chat::with('lastMessage', 'sender', 'receiver')
            ->orderBy('last_message_at', 'desc')
            ->where(function (Builder $q) use ($request, $helpline) {
                $q->where('sender_id', auth()->id());
                if ($helpline) {
                    if (auth()->id() !== 1) {
                        $q->where('receiver_id', 1);
                    } else {
                        $q->whereNot('receiver_id', 1);
                    }
                } else {
                    $q->whereNot('receiver_id', 1);
                }
                if ($request->search) {
                    if ($request->search == 'unread') {
                        $q->where('is_read', false);
                    } else {
                        $q->where('receiver_id', $request->search)->orWhere('sender_id', $request->search);
                    }
                }
            })
            ->orWhere(function (Builder $q) {
                $q->where('receiver_id', auth()->id());
                $q->has('lastMessage');
            })->paginate();
        return ChatData::collect($chats);
    }
}
