<?php

namespace WiGeeky\Todo\Tests\Unit\Http\Middleware;

use WiGeeky\Todo\Tests\Support\WithTask;

class AuthorizeMiddlewareTest extends MiddlewareTestCase
{
    use WithTask;

    /** @test */
    public function it_can_authorize_a_valid_user()
    {
        $task = $this->createTask();
        $response = $this
            ->actingAs($this->user)
            ->getJson('/api/authorize/'.$task->id);

        $response->assertOk();
    }

    /** @test */
    public function it_can_deny_an_invalid_user()
    {
        $task = $this->createTask();
        $response = $this
            ->actingAs($this->createUser())
            ->getJson('/api/authorize/'.$task->id);

        $response->assertNotFound();
    }

    public function it_does_not_interfere_with_normal_routes()
    {
        $response = $this->actingAs($this->user)->getJson('/api/noauth');

        $response->assertOk();
    }
}
