<?php

namespace Tests\Unit;

use App\Models\Poll;
use App\Models\Option;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PollRelationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function poll_has_many_options()
    {
        $poll = Poll::factory()->create();
        Option::factory()->count(3)->create(['poll_id' => $poll->id]);

        $this->assertCount(3, $poll->options);
    }
}
