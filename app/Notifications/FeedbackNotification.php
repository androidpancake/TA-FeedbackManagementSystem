<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeedbackNotification extends Notification
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

        $anonymous = $this->feedback->anonymous ? 'Anonymous' : 'Not anonymous';
        $message = $this->feedback->anonymous ? 'Ada feedback baru' : 'Ada feedback baru oleh';
        return [
            'message' => $message,
            'name' => $this->feedback->user->name,
            'subject' => $this->feedback->subject,
            'class' => $this->feedback->class->name,
            'course' => $this->feedback->class->course->name,
            'img' => $this->feedback->user->profile_photo,
            'anonymous' => $anonymous,
            'url' => route('lecturer.feedback.detail', ['id' => $this->feedback->id]),
        ];
    }
}
