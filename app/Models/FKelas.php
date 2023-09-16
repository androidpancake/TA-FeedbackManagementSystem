<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FKelas extends Model
{
    use HasFactory;

    protected $table = 'fclass';

    protected $fillable = [
        'name',
        'lecturer_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'fclass_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }
}
