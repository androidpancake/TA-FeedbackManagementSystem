<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'subject',
        'content',
        'status',
        'date',
        'closed_date',
        'anonymous',
        'file',
        'category_id',
        'user_id',
        'kelas_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function reply()
    {
        return $this->hasMany(Reply::class);
    }

}
