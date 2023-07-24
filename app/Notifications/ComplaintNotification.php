<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ComplaintNotification extends Notification
{
    use Queueable;

    private $complaint;

    /**
     * Create a new notification instance.
     */
    public function __construct($complaint)
    {
        $this->complaint = $complaint;
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
        return [
            'message' => 'mengirim keluhan tentang',
            'name' => $this->complaint->user->name,
            'subject' => $this->complaint->subject,
            'img' => $this->complaint->user->profile_photo,
            'url' => route('admin.complaint.detail', ['id' => $this->complaint->id]),
        ];
    }
}
