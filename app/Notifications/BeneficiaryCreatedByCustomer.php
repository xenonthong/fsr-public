<?php

namespace App\Notifications;

use App\Models\Beneficiary;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class BeneficiaryCreatedByCustomer extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var \App\Models\Beneficiary
     */
    protected $beneficiary;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Beneficiary $benefificary
     */
    public function __construct(Beneficiary $benefificary)
    {
        $this->benefificary = $benefificary;
    }

    /**
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo()
    {
        return (new NexmoMessage)
            ->content('Hi there, a new beneficiary has been added to your account.');
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
