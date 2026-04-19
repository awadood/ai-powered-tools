<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_the_home_page_renders_the_tool_gallery(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('AI Playground')
            ->assertSee('Flight Disruption Notification')
            ->assertSee('Idea Garden');
    }

    public function test_the_live_tool_page_can_be_opened(): void
    {
        $response = $this->get('/tools/flight-disruption-notification');

        $response
            ->assertOk()
            ->assertSee('Flight Disruption Notification')
            ->assertSee('Build the notification');
    }

    public function test_a_placeholder_tool_page_can_still_be_opened(): void
    {
        $response = $this->get('/tools/meeting-muse');

        $response
            ->assertOk()
            ->assertSee('Meeting Muse')
            ->assertSee('Placeholder page');
    }

    public function test_unknown_tool_pages_return_a_404(): void
    {
        $this->get('/tools/unknown-tool')->assertNotFound();
    }
}
