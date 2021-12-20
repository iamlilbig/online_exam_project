<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_id' => Str::random(10),
            'title' => Str::random(10),
            'instructor_id' => 1,
            'description' => Str::random(50),
            'started_at' => '2021-10-10 10:00:00',
            'ended_At' => '2022-10-10 10:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
