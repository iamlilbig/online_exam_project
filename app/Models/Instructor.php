<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instructor extends Authenticatable

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


    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function tests(): HasManyThrough
    {
        return $this->hasManyThrough(Test::class,Course::class );
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
