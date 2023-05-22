<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'desc',
        'label'
    ];

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'feedback_id','id');
    }
}
