<?php

namespace Tests\Feature;

use App\Models\Poll;
use App\Models\Option;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_poll_can_be_created_with_options()
    {
        $response = $this->post('/polls', [
            'question' => 'What is your favorite color?',
            'options' => ['Red', 'Blue', 'Green']
        ]);

        $response->assertRedirect('/'); // after creation, should go back to index
        $this->assertDatabaseHas('polls', ['question' => 'What is your favorite color?']);
        $this->assertDatabaseCount('options', 3);
    }

    /** @test */
    public function a_user_can_vote_on_a_poll()
    {
        $poll = Poll::factory()->create();
        $option = Option::factory()->create(['poll_id' => $poll->id]);

        $response = $this->post("/polls/{$poll->id}/vote", [
            'option_id' => $option->id
        ]);

        $response->assertRedirect("/polls/{$poll->id}/results");
        $this->assertDatabaseHas('votes', [
            'poll_id' => $poll->id,
            'option_id' => $option->id
        ]);
    }

    /** @test */
    public function a_user_cannot_vote_twice_on_the_same_poll()
    {
        $poll = Poll::factory()->create();
        $option = Option::factory()->create(['poll_id' => $poll->id]);

        // First vote
        $this->post("/polls/{$poll->id}/vote", [
            'option_id' => $option->id
        ], ['REMOTE_ADDR' => '123.45.67.89']);

        // Second vote with same IP
        $this->post("/polls/{$poll->id}/vote", [
            'option_id' => $option->id
        ], ['REMOTE_ADDR' => '123.45.67.89']);

        $this->assertDatabaseCount('votes', 1); // should only store one
    }

    /** @test */
    public function results_can_be_viewed_for_a_poll()
    {
        $poll = Poll::factory()->create(['question' => 'Test poll']);
        $option = Option::factory()->create(['poll_id' => $poll->id]);
        Vote::factory()->create(['poll_id' => $poll->id, 'option_id' => $option->id]);

        $response = $this->get("/polls/{$poll->id}/results");

        $response->assertStatus(200);
        $response->assertSee('Test poll');
        $response->assertSee($option->text);
    }
}
