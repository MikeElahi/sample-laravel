<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
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
        $response = $this->actingAs($this->createUser())->getJson('/api/tasks');
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
}