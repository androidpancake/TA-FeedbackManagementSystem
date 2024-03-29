<?php

namespace App\Notifications;

use App\Models\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SurveyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $survey;

    /**
     * Create a new notification instance.
     */
    public function __construct($survey)
    {
        $this->survey = $survey;
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
        $existingResponse = Response::where('survey_id', $this->survey->id)->where('user_id', $notifiable->id)->first();

        $hasFilled = $existingResponse ? true : false;

        // $existingResponse = Response::where('survey_id', $$this->survey->id)->where('user_id', $notifiable->id)->exists();

        return [
            'survey_id' => $this->survey->id,
            'lecturer' => $this->survey->class->lecturer->name,
            'course' => $this->survey->class->course->name,
            'class' => $this->survey->class->name,
            'message' => 'membagikan survey kelas',
            'url' => route('mahasiswa.survey.fill', ['id' => $this->survey->id]),
            'survey_filled' => $hasFilled,
            'img' => $this->survey->class->lecturer->profile_photo
        ];
    }
}
