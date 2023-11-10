<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BreakNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function /* The `__construct` method is the constructor of the `BreakNotification` class. It
    is called when a new instance of the class is created. In this case, the
    constructor does not have any parameters or perform any actions, as indicated by
    the empty body. */
    __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $recipients = ['admin@kleinbott.com', 'zaeem@kleinbott.com'];

        return (new MailMessage)
            ->subject('Break Notification')
            ->line('Your break has started.')
            ->line('Thank you for using our application!')
            ->bcc($recipients); // Use bcc to specify multiple recipients
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
