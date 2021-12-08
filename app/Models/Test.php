<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Test extends Model
{
    use HasFactory;

    protected $fillable=[
    'title',
    'description',
    'course_id',
    'duration',
    'date',
    'total_score',
    'date',
    'time',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function questions():       BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }
}
