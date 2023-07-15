<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lab extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'lab';

    protected $fillable = [
        'name',
        'username',
        'nim',
        'role',
        'profile_photo',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function class()
    {
        return $this->hasMany(Kelas::class, 'lab_id');
    }
}
