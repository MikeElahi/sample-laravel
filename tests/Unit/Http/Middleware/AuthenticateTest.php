<?php

namespace WiGeeky\Todo\Tests\Unit\Http\Middleware;

use Illuminate\Support\Str;

class AuthenticateTest extends MiddlewareTestCase
{
    /**
     * @test
     */
    public function it_can_authenticate_valid_user()
    {
        $response = $this->getJson('/api/authenticate', [
            'Authorization' => 'Bearer '.$this->user->token,
        ]);
        $response->assertOk();
    }

    /**
     * @test
     */
    public function it_can_fail_to_authenticate_with_invalid_token()
    {
        $response = $this->getJson('/api/authenticate', [
            'Authorization' => 'Bearer '.Str::random(),
        ]);
        $response->assertUnauthorized();
    }

    /**
     * @test
     */
    public function it_can_fail_to_authenticate_with_empty_token()
    {
        $this->createUser(['token' => '']);
        $response = $this->getJson('/api/authenticate', [
            'Authorization' => 'Bearer ',
        ]);
        $response->assertUnauthorized();
    }

    /**
     * @test
     */
    public function it_can_fail_to_authenticate_with_no_token()
    {
        $response = $this->getJson('/api/authenticate');
        $response->assertUnauthorized();
    }

    /**
     * @test
     */
    public function it_can_fail_to_authenticate_with_invalid_header()
    {
        $response = $this->getJson('/api/authenticate', [
            'Authorization' => Str::random(),
        ]);
        $response->assertUnauthorized();
    }
}
