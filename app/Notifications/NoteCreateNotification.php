<?php

namespace App\Notifications;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NoteCreateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Note $note)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New note created')
            ->greeting('Hello ' . $notifiable->name)
            ->line('You have created a new note: ' . $this->note->title)
            ->action('View note', route('notes.show', $this->note->id))
            ->line('Thank you for using NoteKeeper!');
    }

    public function toDatabase(object $notifiable) : array
    {
        return [
            'note_id' => $this->note->id,
            'note_title' => $this->note->title,
            'message' => 'You created a new note: ' . $this->note->title,
        ];
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
