<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'nim',
        'profile_photo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function class()
    {
        return $this->belongsToMany(Kelas::class, 'mahasiswa_kelas', 'user_id','class_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function complaint()
    {
        return $this->hasMany(Complaint::class);
    }

    public function survey()
    {
        return $this->hasMany(Survey::class);
    }

    public function fclass()
    {
        return $this->belongsTo(FKelas::class);
    }
}
