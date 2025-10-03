<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name'   => $this->faker->firstName(),
            'last_name'    => $this->faker->lastName(),
            'email'        => $this->faker->unique()->safeEmail(),
            'date_of_birth'=> $this->faker->date(),
            'password'     => Hash::make('password123'),
        ];
    }
}
