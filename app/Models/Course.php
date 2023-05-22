<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';

    protected $fillable = [
        'code',
        'name',
    ];

    // public function lecturer()
    // {
    //     return $this->belongsTo(Lecturer::class, 'lecturer_id');
    // }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'course_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function users() //mahasiswa
    {
        return $this->belongsToMany(User::class, 'mahasiswa_mata_kuliah');
    }

}
