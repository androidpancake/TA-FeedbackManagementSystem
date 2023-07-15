<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

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

    public function complaint()
    {
        return $this->hasMany(Complaint::class);
    }
}
