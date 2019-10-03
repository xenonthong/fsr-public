<?php

namespace App\Notifications;

use App\Helpers\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class AccountVerified extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        $email = Setting::get('email');

        return (new NexmoMessage)
            ->content("Dear {$notifiable->name}, thank you for choosing FSR. Your account has been verified by our compliance team and you can start using our services 24/7 now.\n\nIf If you did not create this account, please email us at {$email} immediately.");
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
