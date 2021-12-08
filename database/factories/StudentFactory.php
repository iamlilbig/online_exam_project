<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'password' => Hash::make(11338822),
            'name' => $this->faker->name(),
            'is_active' => '1',
            'is_confirmed' => '1'

        ];
    }
}
