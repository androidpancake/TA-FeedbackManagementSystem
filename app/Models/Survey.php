<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'surveys';

    protected $fillable = [
        'date',
        'kelas_id',
        'limit_date',
        'avg_rating',
        'qrcode',
        'type',
        'url'
    ];

    public function question()
    {
        return $this->hasMany(Question::class);
    }
    public function responses()
    {
        return $this->hasMany(Response::class, 'survey_id');
    }

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
