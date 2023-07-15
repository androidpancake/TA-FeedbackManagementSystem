<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LabReplyNotification extends Notification
{
    use Queueable;

    private $feedback;

    /**
     * Create a new notification instance.
     */
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $latestReply = $this->feedback->reply()->latest()->first();
        return [
            'feedback' => $this->feedback->id,
            'message' => 'balasan feedback anda oleh '.$this->feedback->user->name,
            'reply' => $latestReply ? $latestReply->reply : null,
            'url' => route('lab.feedback.detail', ['id' => $this->feedback->id]),
            'img' => $this->feedback->user->profile_photo
        ];
    }
}
