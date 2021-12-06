<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
