<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PollFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
        ];
    }
}
