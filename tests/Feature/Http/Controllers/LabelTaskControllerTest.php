<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use WiGeeky\Todo\Models\Label;
use WiGeeky\Todo\Tests\Support\WithTask;
use WiGeeky\Todo\Tests\TestCase;

class LabelTaskControllerTest extends TestCase
{
    use WithTask;
    use WithoutMiddleware;

    /**
     * As a logged-in user, I should be able to add 1+n labels to a task.
     *
     * @test
     */
    public function it_can_add_n_labels_to_a_task()
    {
        $task = $this->createTask();
        $times = $this->faker->numberBetween(1, 10);

        $response = $this->actingAs($this->user)->postJson(
            "/api/tasks/{$task->id}/labels",
            factory(Label::class)->times($times)->make()->pluck('label')->toArray(),
        );

        $response->assertNoContent();
        $this->assertDatabaseCount('label_task', $times);
    }
}