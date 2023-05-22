<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerReply extends Model
{
    use HasFactory;

    protected $table = 'replies_lecturer';

    protected $fillable = [
        'reply',
        'feedback_id',
        'lecturer_id'
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }
}
