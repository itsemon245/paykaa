<?php

namespace App\Notifications;

use App\Data\MessageData;
use App\Data\MoneyRequestData;
use App\Models\MoneyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MoneyReqeuestNotification extends Notification implements ShouldQueue, ShouldQueueAfterCommit
{
    use Queueable;
    public MoneyRequestData $moneyRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(MoneyRequestData $moneyRequest)
    {
        $this->moneyRequest = $moneyRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'moneyRequest' => $this->moneyRequest,
            'sender_id' => $this->moneyRequest->sender_id,
            'receiver_id' => $this->moneyRequest->receiver_id,
        ];
    }
}
