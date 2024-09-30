<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification
{
    use Queueable;

    public $message;
    public $url; // Declare the custom URL property

    /**
     * Create a new notification instance.
     *
     * @param string $message
     * @param string $url
     * @return void
     */
    public function __construct($message, $url)
    {
        $this->message = $message;
        $this->url = $url; // Set the custom URL
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->message)
                    ->action('View Details', $this->url) // Use the custom URL
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification for storing in the database.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'url' => $this->url, // Store the custom URL in the database
        ];
    }
}
