<?php

namespace Database\Factories;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'unique_id' => $this->faker->unique()->name,
            'title' => $this->faker->title,
            'instructor_id' => rand(0,10),
            'description' => $this->faker->text(100),
            'started_at' => $this->faker->date(),
            'ended_at' => $this->faker->date(),
        ];
    }
}
