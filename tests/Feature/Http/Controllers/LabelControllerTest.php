<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use WiGeeky\Todo\Models\Label;
use WiGeeky\Todo\Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use WithFaker;

    /**
     * As a logged-in user, I should be able to add label. So that I can label tasks to filter those.
     *
     * @test
     */
    public function it_can_add_labels()
    {
        $label = $this->faker->words(6, true);
        $response = $this->actingAs($this->user)->postJson('/api/labels', [
            'label' => $label,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('labels', [
            'label' => $label,
        ]);
    }

    /**
     * User may attempt to create a pre-existing label, the same label must be returned with 200 OK code.
     *
     * @test
     */
    public function it_can_post_existing_label()
    {
        $label = factory(Label::class)->create()->label;

        $response = $this->actingAs($this->user)->postJson('/api/labels', [
            'label' => $label,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('labels', [
            'label' => $label,
        ]);
    }

    /**
     * As a logged-in user, I should be able to get list of labels.
     *
     * @test
     */
    public function it_can_get_a_list_of_labels()
    {
        factory(Label::class)->times(10)->create();

        $response = $this->actingAs($this->user)->getJson('api/labels');

        $response->assertOk();
        $response->assertJsonCount(10, 'data');
        $response->assertJsonStructure([
            'data' => ['*' => [
                'id',
                'label',
                'count',
            ]],
        ]);
    }
}
