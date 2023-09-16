<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyLabNotification extends Notification
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
        //dari lab ke mahasiswa
        return [
            'feedback' => $this->feedback->id,
            'subject' => $this->feedback->subject,
            'name' => $this->feedback->class->lab->name,
            'message' => 'membalas umpan balik anda tentang',
            'class' => $this->feedback->class->name,
            'course' => $this->feedback->class->course->name,
            'reply' => $latestReply ? $latestReply->reply : null,
            'url' => route('mahasiswa.feedback.detail', ['id' => $this->feedback->id]),
            'img' => $this->feedback->class->lab->profile_photo
        ];
    }
}
