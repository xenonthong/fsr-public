<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class AccountUpdatedByCustomer extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        $email = Setting::get('email');

        return (new NexmoMessage)
            ->content("Dear {$notifiable->name}, your profile have been updated.\n\nIf this was an unauthorised action, please email us at {$email} immediately.");
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
