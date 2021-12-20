<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
                'title' => Str::random(10),
                'description' => Str::random(50),
                'duration' => $this->faker->numberBetween(10,50),
                'datetime' => '2020-10-10 10:00:00',
                'endtime' => $this->faker->dateTimeBetween('2020-10-10 10:00:00','2022-10-10 10:00:00'),
        ];
    }
}
