<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserComplaintReplyNotification extends Notification
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
        $latestReply = $this->complaint->complaint_reply()->latest()->first();
        return [
            'complaint' => $this->complaint->id,
            'message' => 'Anda mendapatkan balasan pengaduan dari',
            'subject' => $this->complaint->subject,
            'name' => $this->complaint->user->name,
            'img' => $this->complaint->user->profile_photo,
            'reply' => $latestReply ? $latestReply->reply : null,
            'url' => route('admin.complaint.detail', ['id' => $this->complaint->id]),
        ];
    }
}
