<?php

namespace Database\Factories;

use App\Models\Poll;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'poll_id' => Poll::factory(),
            'option_id' => Option::factory(),
            'voter_ip' => $this->faker->ipv4,
        ];
    }
}
