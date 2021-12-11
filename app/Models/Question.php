<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    public function tests(): BelongsToMany
    {
        return $this->belongsToMany(Test::class,'question_tests');
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    public function questionType(): BelongsTo
    {
        return $this->belongsTo(QuestionType::class);
    }

    protected $fillable = [
        'instructor_id',
        'title',
        'content',
        'question_type_id',
        'photo',
        'default_score',
        'answers',
        'correct_answer',
    ];
}
