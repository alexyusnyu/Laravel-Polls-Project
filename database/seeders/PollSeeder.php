<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poll;

class PollSeeder extends Seeder
{
    public function run()
    {
        $poll = Poll::create([
            'question' => 'What are your vacation plans?'
        ]);

        $poll->options()->createMany([
            ['text' => "I'm going to the beach"],
            ['text' => "I'm going to the mountains"],
            ['text' => "I'm going to my village"],
            ['text' => "Visiting friends abroad"],
            ['text' => "No plans"]
        ]);
    }
}
