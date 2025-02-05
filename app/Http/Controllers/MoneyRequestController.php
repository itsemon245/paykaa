<?php

namespace App\Http\Controllers;

use App\Enum\MessageType;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MoneyRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

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
            $moneyRequest = MoneyRequest::create([
                ...$request->only('amount', 'note', 'receiver_id'),
                'sender_id' => auth()->id(),
                'message_id' => $message->id,
            ]);
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
            return back();
        });
    }

    public function cancel(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            $moneyRequest->cancelled_at = now();
            $moneyRequest->save();
            return back();
        });
    }

    public function reject(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            $moneyRequest->rejected_at = now();
            $moneyRequest->save();
            return back();
        });
    }
    public function requestToRelease(Request $request, MoneyRequest $moneyRequest)
    {
        return backWithError(function () use ($request, $moneyRequest) {
            $moneyRequest->update([
                'release_requested_at' => now(),
            ]);
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
            return back();
        });
    }
}
