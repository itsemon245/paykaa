<?php

use App\Data\MoneyRequestData;
use App\Enum\MessageType;
use App\Models\Message;
use App\Models\MoneyRequest;
use Illuminate\Support\Facades\DB;


/**
 * Generates a random avatar
 * @param string|null $seed keep null to generate get `auth()->user()->avatar` if not authenticated it will generate a random avatar
 * @return string
 */
function avatar(string $seed = null): string
{
    return asset("/assets/images/user.png");
}

/**
 * Uses transaction to prevent any unintentional writes to database and returns back with a toast.
 *
 * @param callable $callback
 * @param string|null $urlToRedirect
 * @return Illuminate\Routing\Redirector|Illuminate\Http\RedirectResponse|Illuminate\Http\Response|Illuminate\Contracts\Routing\ResponseFactory
 */
function backWithError(callable $callback)
{
    try {
        DB::beginTransaction();
        $response = $callback();
        DB::commit();
        return $response;
    } catch (\Exception $th) {
        DB::rollBack();
        if (config('app.env') == 'local') {
            throw $th;
        }
        if (request()->expectsJson()) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ]);
        }
        return back()->with('error', $th->getMessage());
    }
}

function useImage(string $url): string
{
    return str($url)->startsWith('http') ? $url : asset("storage/" . $url);
}

function moneyRequestMessage(MoneyRequest $moneyRequest, Message $message = null, $messageType = null)
{
    $moneyRequest->refresh();
    $moneyRequest->loadMissing('from');
    if (!$message) {
        $message = Message::create([
            'chat_id' => $moneyRequest->message->chat_id,
            'sender_id' => $moneyRequest->sender_id,
            'receiver_id' => $moneyRequest->receiver_id,
            'type' => MessageType::MoneyRequest->value,
            'body' => "Money Request to {$moneyRequest->receiver->name} from " . auth()->user()->name,
            'data' => MoneyRequestData::from($moneyRequest),
            'og_money_request_id' => $moneyRequest->id,
        ]);
        if ($messageType == 'release') {
            $moneyRequest->release_message_id = $message->id;
            $moneyRequest->save();
        }
        if ($messageType == 'report') {
            $moneyRequest->report_message_id = $message->id;
            $moneyRequest->save();
        }
        return $message;
    }
    if ($message->type == MessageType::MoneyRequest->value) {
        $message->data = MoneyRequestData::from($moneyRequest);
        $message->og_money_request_id = $moneyRequest->id;
        $message->save();
    }
    return $message;
}
