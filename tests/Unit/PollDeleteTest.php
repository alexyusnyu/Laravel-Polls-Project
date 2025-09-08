<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Poll;

class PollDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_poll_can_be_deleted()
    {
        // Step 1: Create a poll
        $poll = Poll::factory()->create([
            'question' => 'Poll to Delete'
        ]);

        // Step 2: Delete the poll
        $response = $this->delete("/polls/{$poll->id}");

        // Step 3: Assert redirect (usually to polls index)
        $response->assertStatus(302);

        // Step 4: Assert poll no longer exists
        $this->assertDatabaseMissing('polls', [
            'id' => $poll->id
        ]);
    }
}
