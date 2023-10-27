<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactsNotification extends Notification
{
    public $id;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $id)
    {
        $this->id = $id;
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
        $contact = Contact::findOrFail($this->id);
        return (new MailMessage)
                    ->greeting('Hello')
                    ->line($contact->name .' ' . $contact->last_name)
                    ->line('email: '. $contact->email)
                    ->line('Subject: '. $contact->subject)
                    ->line('Content: '. $contact->content);
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
