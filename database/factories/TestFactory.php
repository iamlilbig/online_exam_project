<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->text(100),
            'course_id' => rand(0,10),
            'duration' => $this->faker->numberBetween(10,120),
            'date' => $this->faker->date(),
            'time' => $this->faker->time('H:i'),
        ];
    }
}
