<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'replies';

    protected $fillable = [
        'reply',
        'feedback_id',
        'user_id',
        'lecturer_id'
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'user_id');
    }
}
