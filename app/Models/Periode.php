<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'period';

    protected $fillable = [
        'periode',
        'periode_start',
        'periode_end',
    ];  

}
