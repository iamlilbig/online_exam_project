<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'question_id',
        'default_score'
        ];
}
