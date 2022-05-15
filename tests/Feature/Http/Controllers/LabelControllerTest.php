<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use WiGeeky\Todo\Models\Label;
use WiGeeky\Todo\Tests\Feature\FeatureTestCase;

class LabelControllerTest extends FeatureTestCase
{
    use WithFaker;
    use WithoutMiddleware;

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
           'label' =>  $label,
        ]);
    }

    /**
     * User may attempt to create a pre-existing label, the same label must be returned with 200 OK code
     */
    public function it_can_post_existing_label()
    {
        $label = factory(Label::class)->create()->label;

        $response = $this->actingAs($this->createUser())->postJson('/api/labels', [
            'label' => $label,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('labels', [
            'label' =>  $label,
        ]);
    }
}