<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Middlewares;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use WiGeeky\Todo\Http\Middleware\Authenticate;
use WiGeeky\Todo\Tests\Feature\FeatureTestCase;

class AuthenticateTest extends FeatureTestCase
{
    protected function usesAuthRoutes($app)
    {
        Route::get('/api/auth', function () {
            return 'OK';
        })->middleware(Authenticate::class);
    }

    /**
     * @define-route usesAuthRoutes
     * @test
     */
    public function it_can_authenticate_valid_user()
    {
        $response = $this->getJson('/api/auth', [
            'Authorization' => "Bearer " . $this->createUser()->token
        ]);
        $response->assertOk();
    }

    /**
     * @define-route usesAuthRoutes
     * @test
     */
    public function it_can_fail_to_authenticate_with_invalid_token()
    {
        $response = $this->getJson('/api/auth', [
            'Authorization' => "Bearer " . Str::random()
        ]);
        $response->assertUnauthorized();
    }

    /**
     * @define-route usesAuthRoutes
     * @test
     */
    public function it_can_fail_to_authenticate_with_empty_token()
    {
        $this->createUser(['token' => '']);
        $response = $this->getJson('/api/auth', [
            'Authorization' => "Bearer "
        ]);
        $response->assertUnauthorized();
    }

    /**
     * @define-route usesAuthRoutes
     * @test
     */
    public function it_can_fail_to_authenticate_with_no_token()
    {
        $response = $this->getJson('/api/auth');
        $response->assertUnauthorized();
    }

    /**
     * @define-route usesAuthRoutes
     * @test
     */
    public function it_can_fail_to_authenticate_with_invalid_header()
    {
        $response = $this->getJson('/api/auth', [
            'Authorization' => Str::random()
        ]);
        $response->assertUnauthorized();
    }

}