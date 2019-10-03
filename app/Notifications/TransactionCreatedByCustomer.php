<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class TransactionCreatedByCustomer extends Notification implements ShouldQueue
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
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content("Dear {$notifiable->name}, we have received your remittance order of {$this->transaction->to_currency} {$this->transaction->to_amount} to Johnson on {$this->transaction->created_at->format('d/m/Y')}.\n\nPlease upload your proof of payment through your transaction details page in order for us to process your order.");
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
