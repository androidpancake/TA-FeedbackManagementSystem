<?php

namespace App\Models;

use Egulias\EmailValidator\Result\Reason\Reason;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalResponse extends Model
{
    use HasFactory;

    protected $table = 'additional_response';

    protected $fillable = [
        'reason',
        'for'
    ];

    public function response()
    {
        return $this->hasMany(Response::class);
    }
}
