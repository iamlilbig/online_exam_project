<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseStudent extends pivot
{
    use HasFactory;

    protected $fillable=[
        'course_id',
        'student_id',
    ];

    public $timestamps = false;

    protected $table= 'course_students';
}
