<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    use HasFactory;

    protected $fillable=[
    'title',
    'description',
    'course_id',
    'duration',
    'total_score',
    'datetime',
    'endtime'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class,'question_tests')->withPivot('default_score')->using(QuestionTest::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
