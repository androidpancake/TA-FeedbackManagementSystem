<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lecturer extends Authenticatable
{
    use HasFactory;

    protected $table = 'lecturer';

    protected $fillable = [
        'name',
        'username',
        'nim',
        'email',
        'password'
    ];

    //feedback
    // public function feedback()
    // {
    //     return $this->hasMany(Feedback::class);
    // }

    // //mata kuliah
    // public function course()
    // {
    //     return $this->hasMany(Kelas::class);
    // }
        
    public function class()
    {
        return $this->hasMany(Kelas::class);
    }

}
