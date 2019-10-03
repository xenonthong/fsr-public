<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class TransactionRequestRejected extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var \App\Models\Transaction
     */
    protected $transaction;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo()
    {
        return (new NexmoMessage)
            ->content("Hi there, transaction #{$this->transaction->id} has been rejected by the admin.");
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }
}
