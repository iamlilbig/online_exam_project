<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instructor extends Authenticatable

{
    use HasFactory;
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
        return $this->hasMany(Course::class);
    }
}
