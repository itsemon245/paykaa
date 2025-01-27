<?php

namespace App\Http\Controllers;

use App\Enum\MessageType;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MoneyRequest;
use App\Models\User;
use Illuminate\Http\Request;

class MoneyRequestController extends Controller
{
    public function request(Request $request)
    {
        return backWithError(function () use ($request) {
            $receiver = User::find($request->receiver_id);
            $request->validate([
                'amount' => 'required|numeric|min:1|max:' . $receiver->balance,
                'note' => 'nullable|string',
                'receiver_id' => 'required|numeric|exists:users,id',
                'chat_id' => 'required|numeric|exists:chats,id',
            ]);
            $message = Message::create([
                'chat_id' => $request->chat_id,
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id,
                'type' => MessageType::MoneyRequest->value,
                'body' => "Money Request to {$receiver->name} from " . auth()->user()->name,
            ]);
            $moneyRequest = new MoneyRequest([
                ...$request->only('amount', 'note', 'receiver_id'),
                'sender_id' => auth()->id(),
                'message_id' => $message->id,
            ]);
            return redirect(route('chat.show', ['chat' => Chat::find($request->chat_id)]));
        });
    }

    public function accept(Request $request, MoneyRequest $moneyRequest)
    {
        return back();
    }
}
