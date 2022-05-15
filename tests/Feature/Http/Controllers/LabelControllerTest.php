<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use WiGeeky\Todo\Tests\Feature\FeatureTestCase;

class LabelControllerTest extends FeatureTestCase
{
    use WithFaker;

    /**
     * As a logged-in user, I should be able to add label. So that I can label tasks to filter those.
     * @test
     */
    public function it_can_add_labels()
    {
        $label = $this->faker->words(6, true);
        $response = $this->actingAs($this->createUser())->postJson('/api/labels', [
            'label' => $label,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('labels', [
           'title' =>  $label,
        ]);
    }
}