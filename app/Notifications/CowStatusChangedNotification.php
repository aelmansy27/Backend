<?php

namespace App\Notifications;

use App\Models\Cow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CowStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $cows;
    /**
     * Create a new notification instance.
     */
    public function __construct(array $cows)
    {
        $this->cows = $cows;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject('Cow Status Changed')
            ->line('The status of the following cows has changed:');

        foreach ($this->cows as $cow) {
            $mailMessage->line('Cow ID: ' . $cow->cowId . ', Status: ' . $cow->cow_status);
        }

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
