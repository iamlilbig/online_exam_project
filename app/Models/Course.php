<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'description',
        'unique_id',
        'instructor_id',
        'started_at',
        'ended_at',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class,'course_students','course_id','student_id');
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
