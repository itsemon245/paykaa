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
        if ((int)$request->search) {
            $chat = null;
            $people = [auth()->user()->id, $request->search];
            if (auth()->id() != $request->search) {
                if (auth()->user()->id == 1) {
                    $chat = Chat::where('sender_id', $request->search)->where('receiver_id', 1)->first();
                } else {
                    $chat = Chat::myChats($request->search)->first();
                }
                if (!$chat) {
                    $userExists = User::whereNot('id', auth()->id()) //skip self
                        ->whereNot('id', 1) //skip admin
                        ->where('id', $request->search)->exists();
                    if ($userExists) {
                        $chatData = [
                            'sender_id' => auth()->user()->id == 1 ? $request->search : auth()->user()->id,
                            'receiver_id' => auth()->user()->id != 1 ? $request->search : auth()->user()->id,
                        ];
                        $chat = Chat::updateOrCreate($chatData, $chatData);
                    }
                }
            }
        }
        return response()->json($this->getChats($request, $request->helpline));
    }

    public function show(Request $request, Chat $chat)
    {
        $chat->messages()->received()->unread()->update(['is_read' => true]);
        $chat->loadMissing('sender', 'receiver', 'lastMessage');
        Chat::myChats()->where('uuid', $chat->uuid)->where('is_read', false)->update(['is_read' => true]);

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
        // $people = [auth()->user()->id, $adminId];
        $chat = Chat::where('receiver_id', $adminId)->where('sender_id', auth()->user()->id)->first();
        if (!$chat) {
            if (auth()->user()->id == 1) {
                $chat = Chat::where('receiver_id', $adminId)->orderBy('last_message_at', 'desc')->first();
            } else {
                $chat = Chat::create([
                    'sender_id' => auth()->user()->id,
                    'receiver_id' => $adminId,
                ]);
            }
        }
        $chat->messages()->received()->unread()->update(['is_read' => 1]);
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
        $chat = Chat::myChats($receiver->id)->first();
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
        $chats = Chat::with('lastMessage', 'sender', 'receiver')->clone();
        $chats->myChats($request->search);
        if (auth()->user()->isAdmin()) {
            $chats->where('receiver_id', 1);
            $chats->whereNot('sender_id', 1);
            $chats->whereHas('lastMessage');
        } else {
            if ($helpline) {
                $chats->where('receiver_id', 1);
            } else {
                $chats->whereNot('receiver_id', 1);
                if ($request->search) {
                    $chats->withEmpty();
                }
            }
        }
        $chats = $chats->paginate();
        return ChatData::collect($chats);
    }
}
