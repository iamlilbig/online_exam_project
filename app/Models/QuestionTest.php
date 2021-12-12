<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class QuestionTest extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'question_id',
        'default_score'
        ];
}
