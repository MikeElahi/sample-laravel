<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use WiGeeky\Todo\Models\Label;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Tests\Feature\FeatureTestCase;

class TaskControllerTest extends FeatureTestCase
{
    use WithoutMiddleware;

    // Avoid testing Authenticate middleware


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
            'data' => ['*' => [
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

    /**
     * As a logged-in user, I should not be able to get list of other user's tasks.
     * @test
     */
    public function it_does_not_list_other_user_tasks()
    {
        // Prepare
        $someOtherUser = $this->createUser();
        $someOtherUser->tasks()->createMany(
            factory(Task::class)->times(5)->make()->toArray()
        );
        $someOtherUser->tasks()->each(function ($task) {
            $task->labels()->attach(factory(Label::class)->create());
        });

        // Execute
        $response = $this->actingAs($this->createUser())->getJson('/api/tasks');

        // Assert
        $response->assertOk();
        $response->assertJsonCount(0, 'data');
        $response->assertJsonStructure([
            'data',
        ]);
    }

    /**
     * As a logged-in user, I should be able to add a new Task.
     * @test
     */
    public function it_can_add_a_new_task()
    {
        // Prepare
        $user = $this->createUser();

        // Execute
        $response = $this->actingAs($user)->postJson('/api/tasks', [
            'title' => $this->faker->words(6, true),
            'description' => $this->faker->paragraph(),
            'labels' => factory(Label::class)->times(2)->create()->pluck('id')
        ]);

        // Assert
        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'labels' => ['*' => [
                    'id',
                    'label',
                    'count',
                ]]
            ]
        ]);
        $response->assertJsonFragment(['count' => 1]);
    }


    /**
     * As a logged-in user, I should be able to edit a Task. (Title and Description)
     * @test
     */
    public function it_can_update_an_existing_task()
    {
        // Prepare
        $user = $this->createUser();
        $task = $user->tasks()->create(
            factory(Task::class)->make()->toArray()
        );
        $newTitle = $this->faker->words(6, true);

        // Execute
        $response = $this->actingAs($user)->putJson("/api/tasks/{$task->id}", [
            'title' => $newTitle,
            'description' => $this->faker->paragraph(),
        ]);

        $response->assertNoContent();
        $this->assertDatabaseHas('tasks', ['title' => $newTitle]);
    }
}