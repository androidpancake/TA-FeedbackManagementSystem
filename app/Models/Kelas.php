<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'class';

    protected $fillable = [
        'name',
        'header',
        'course_id',
        'lecturer_id'
    ];

    //mahasiswa
    public function user()
    {
        return $this->belongsToMany(User::class, 'mahasiswa_kelas', 'user_id', 'class_id');
    }

    //mata kuliah
    public function course() 
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    //dosen
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);    
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

}
