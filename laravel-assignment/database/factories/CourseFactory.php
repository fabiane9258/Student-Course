<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_code' => strtoupper($this->faker->unique()->bothify('CSE###')),
            'course_name' => $this->faker->sentence(3),
            'credits'     => $this->faker->numberBetween(1, 6),
        ];
    }
}
