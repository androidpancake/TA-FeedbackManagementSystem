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
        'lecturer_id',
        'lab_id'
    ];

    //mahasiswa
    public function user()
    {
        return $this->belongsToMany(User::class, 'mahasiswa_kelas', 'class_id', 'user_id');
    }

    //mata kuliah
    public function course() 
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    //dosen
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');    
    }

    //lab
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function survey()
    {
        return $this->hasMany(Survey::class);
    }

    public function responses()
    {
        return $this->hasManyThrough(Response::class, Survey::class);
    }

}
