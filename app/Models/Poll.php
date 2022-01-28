<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Poll extends Model
{
    use HasFactory;
    protected $table = "poll";
    protected $fillable = [
        'title',
        'answers',
        'user_id',
        'start',
        'end',
    ];
}
