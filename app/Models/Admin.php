<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'admin';

    protected $fillable = [
        'name',
        'username',
        'nip',
        'role',
        'email',
        'password',
        'profile_photo'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];



    public function complaint()
    {
        return $this->hasMany(Complaint::class);
    }
}
