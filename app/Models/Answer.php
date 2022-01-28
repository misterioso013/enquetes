<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = "poll_answers";
    protected $fillable = [
        'answer',
        'user_id',
        'poll_id'
    ];
}
