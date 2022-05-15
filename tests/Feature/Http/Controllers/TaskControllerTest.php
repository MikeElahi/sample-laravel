<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use WiGeeky\Todo\Models\Label;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Tests\Feature\FeatureTestCase;

class TaskControllerTest extends FeatureTestCase
{
    use WithoutMiddleware; // Avoid testing Authenticate middleware


    /**
     * As a logged-in user, I should be able to get list of tasks with labels.
     * @test
     */
    public function it_can_get_list_of_tasks_with_labels()
    {
        // Prepare
        $user = $this->createUser();
        $user->tasks()->createMany(
            factory(Task::class)->times(5)->make()->toArray()
        );
        $user->tasks()->each(function ($task) {
           $task->labels()->attach(factory(Label::class)->create());
        });

        // Execute
        $response = $this->actingAs($user)->getJson('/api/tasks');
        // Assert
        $response->assertOk();
        $response->assertJsonCount(5, 'data');
        $response->assertJsonStructure([
            'data' => [ '*' => [
                'id',
                'title',
                'description',
                'labels' => [
                    '*' => [
                        'id',
                        'label',
                        'count',
                    ]
                ],
            ]],
        ]);
    }
}