<?php

namespace App\Http\Controllers;

use App\Data\MoneyRequestData;
use App\Enum\MessageType;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MoneyRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class MoneyRequestController extends Controller
{
    public function moneyRequestMessage(MoneyRequest $moneyRequest, Message $message = null, $messageType = null)
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
    public function request(Request $request)
    {
        return backWithError(function () use ($request) {
            $receiver = User::find($request->receiver_id);
            $validator = Validator::make($request->all(), [
                'amount' => 'required|numeric|min:1|max:' . $receiver->balance,
                'note' => 'nullable|string',
                'receiver_id' => 'required|numeric|exists:users,id',
                'chat_id' => 'required|numeric|exists:chats,id',
                'duration' => 'required|array',
                'duration.day' => 'required|numeric|max:31',
                'duration.hour' => 'required|numeric|max:24',
                'duration.minute' => 'required|numeric|max:60',
            ]);

            $requestPending = MoneyRequest::where(function ($query) use ($request) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $request->receiver_id);
            })->whereNull('released_at')
                ->where(function ($query) {
                    $query->whereNull('accepted_at');
                    $query->orWhereNotNull('accepted_at');
                })
                ->whereNull('cancelled_at')
                ->whereNull('rejected_at')
                ->exists();
            if ($requestPending) {
                $validator->after(function ($validator) {
                    $validator->errors()->add('amount', 'A Request already pending');
                });
            }
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $message = Message::create([
                'chat_id' => $request->chat_id,
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id,
                'type' => MessageType::MoneyRequest->value,
                'body' => "Money Request to {$receiver->name} from " . auth()->user()->name,
            ]);
            $moneyRequest = MoneyRequest::create([
                ...$request->only('amount', 'note', 'receiver_id'),
                'sender_id' => auth()->id(),
                'message_id' => $message->id,
                'duration' => $request->duration,
            ]);
            event(new \App\Events\MessageCreated($this->moneyRequestMessage($moneyRequest, $moneyRequest->message)));
            return back();
        });
    }

    public function accept(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            if ($moneyRequest->accepted_at) {
                return back();
            }
            $moneyRequest->accepted_at = now();
            $moneyRequest->expires_at = now()->addMinutes($moneyRequest->duration['minute'])->addHours($moneyRequest->duration['hour'])->addDays($moneyRequest->duration['day']);
            $moneyRequest->save();
            Wallet::create([
                'owner_id' => auth()->id(),
                'user_id' => $moneyRequest->sender_id, //the request sender should receive the money
                'money_request_id' => $moneyRequest->id,
                'transaction_id' => Uuid::uuid4()->toString(),
                'transaction_type' => WalletTransactionType::TRANSFER->value,
                'type' => WalletType::DEBIT->value,
                'amount' => $moneyRequest->amount,
                'currency' => 'BDT',
                'note' => $moneyRequest->note,
                'payment_number' => $moneyRequest->sender_id,
            ]);
            event(new \App\Events\MessageCreated($this->moneyRequestMessage($moneyRequest, $moneyRequest->message)));
            return back();
        });
    }

    public function cancel(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            $moneyRequest->cancelled_at = now();
            $moneyRequest->save();
            event(new \App\Events\MessageCreated($this->moneyRequestMessage($moneyRequest, $moneyRequest->message)));
            return back();
        });
    }

    public function reject(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            $moneyRequest->rejected_at = now();
            $moneyRequest->save();
            event(new \App\Events\MessageCreated($this->moneyRequestMessage($moneyRequest, $moneyRequest->message)));
            return back();
        });
    }
    public function requestToRelease(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            $moneyRequest->update([
                'release_requested_at' => now(),
            ]);
            event(new \App\Events\MessageCreated($this->moneyRequestMessage($moneyRequest, messageType: 'release')));
            return back();
        });
    }
    public function release(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            $transaction = $moneyRequest->transaction;
            if ($transaction->released_at) {
                return back();
            }
            $transaction->update([
                'approved_at' => now(),
                'cancelled_at' => null,
                'failed_at' => null,
            ]);
            Wallet::create([
                'user_id' => auth()->id(),
                'owner_id' => $moneyRequest->sender_id, //the request sender should receive the money
                'transaction_id' => Uuid::uuid4()->toString(),
                'transaction_type' => WalletTransactionType::TRANSFER->value,
                'type' => WalletType::CREDIT->value,
                'amount' => $transaction->amount,
                'currency' => $transaction->currency,
                'note' => $transaction->note,
                'payment_number' => $moneyRequest->receiver_id,
                'approved_at' => now(),
            ]);

            $moneyRequest->update([
                'released_at' => now(),
                'rejected_at' => null,
            ]);
            event(new \App\Events\MessageCreated($this->moneyRequestMessage($moneyRequest, $moneyRequest->releaseMessage)));
            return back();
        });
    }

    public function report(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            $moneyRequest->update([
                'reported_by' => auth()->id(),
                'reported_at' => now(),
                'cancelled_at' => null,
                'rejected_at' => null,
            ]);
            event(new \App\Events\MessageCreated($this->moneyRequestMessage($moneyRequest, messageType: 'report')));
            return back();
        });
    }
}
