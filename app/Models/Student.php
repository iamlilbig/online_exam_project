<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $fillable=[
        'phone',
        'name',
        'email',
        'password',
        'is_active',
        'is_confirmed'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_students','student_id','course_id')->using(CourseStudent::class);
    }

}
