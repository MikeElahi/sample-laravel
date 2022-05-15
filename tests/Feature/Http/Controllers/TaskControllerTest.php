<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use WiGeeky\Todo\Models\Label;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Tests\Support\WithTask;
use WiGeeky\Todo\Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use WithoutMiddleware; // Avoid testing Authenticate middleware
    use WithTask;

    /**
     * As a logged-in user, I should be able to get list of tasks with labels.
     * @test
     */
    public function it_can_get_list_of_tasks_with_labels()
    {
        // Prepare
        
        $this->createTask(5);
        $this->user->tasks()->each(function ($task) {
            $task->labels()->attach(factory(Label::class)->create());
        });

        // Execute
        $response = $this->actingAs($this->user)->getJson('/api/tasks');
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
     * As a logged-in user, I should be able to get list of tasks with labels.
     * @test
     */
    public function it_can_get_tasks_filtered_by_label()
    {
        // Prepare
        
        /** @var Label $filterLabel */
        $filterLabel = factory(Label::class)->create();
        $this->createTask(10);

        $this->user->tasks()
            ->take(5)
            ->get() // using each directly would cause this loop to run 10 times
            ->each(function ($task) use ($filterLabel) {
                $task->labels()->attach($filterLabel);
            });

        // Execute
        $response = $this->actingAs($this->user)->getJson('/api/tasks?label=' . $filterLabel->id);
        // Assert
        $response->assertOk();
        $response->assertJsonCount(5, 'data');
    }

    /**
     * As a logged-in user, I should be able to get details of a task.
     * @test
     */
    public function it_can_get_details_about_a_specific_task()
    {
        // Prepare
        
        /** @var Task $task */
        $task = $this->createTask();
        $task->labels()->attach(factory(Label::class)->create());

        // Execute
        $response = $this->actingAs($this->user)->getJson("/api/tasks/{$task->id}");
        // Assert
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
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
            ],
        ]);
    }

    /**
     * As a logged-in user, I should not be able to get details of other user's tasks.
     * @test
     */
    public function it_does_not_show_other_users_task()
    {
        // Prepare
        $someOtherUser = $this->createUser();
        /** @var Task $task */
        $task = $someOtherUser->tasks()->create(
            factory(Task::class)->make()->toArray()
        );

        // Execute
        $response = $this->actingAs($this->user)->getJson("/api/tasks/{$task->id}");

        // Assert
        $response->assertNotFound();
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
        $response = $this->actingAs($this->user)->getJson('/api/tasks');

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
        // Execute
        $response = $this->actingAs($this->user)->postJson('/api/tasks', [
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
        $task = $this->createTask();
        $newTitle = $this->faker->words(6, true);
        $response = $this->actingAs($this->user)->putJson("/api/tasks/{$task->id}", [
            'title' => $newTitle,
            'description' => $this->faker->paragraph(),
        ]);

        $response->assertNoContent();
        $this->assertDatabaseHas('tasks', ['title' => $newTitle]);
    }

    /**
     * As a logged-in user, I should be able to change status of a Task.
     *
     * @test
     */
    public function it_can_update_existing_task_status()
    {
        
        $task = $this->createTask();

        $response = $this->patchJson("/api/tasks/{$task->id}", [
            'status' => Task::STATUS_CLOSE,
        ]);

        $response->assertNoContent();
        $this->assertDatabaseHas('tasks', [
            'status' => Task::STATUS_CLOSE,
        ]);
    }
}