<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PollCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_poll_can_be_created_with_options()
    {
        $response = $this->post('/polls', [
            'question' => 'Test Poll',
            'options' => ['Option 1', 'Option 2']
        ]);

        // Assert redirect
        $response->assertStatus(302);

        // Assert poll exists in DB
        $this->assertDatabaseHas('polls', [
            'question' => 'Test Poll'
        ]);

        // Assert options exist in DB
        $this->assertDatabaseHas('options', [
            'text' => 'Option 1'
        ]);
        $this->assertDatabaseHas('options', [
            'text' => 'Option 2'
        ]);
    }
}
