<?php

namespace App\Http\Controllers;

use App\Data\MessageData;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Chat $chat, Request $request)
    {
        $messageData = MessageData::from($request->all());
        $message = Message::create([
            ...$messageData->only('chat_id', 'sender_id', 'receiver_id', 'type', 'body')->toArray(),
        ]);
        return back();
    }
}
