<?php

namespace WiGeeky\Todo\Tests\Feature\Http\Middlewares;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use WiGeeky\Todo\Http\Middleware\Authenticate;
use WiGeeky\Todo\Tests\TestCase;

class AuthenticateTest extends TestCase
{
    protected function usesAuthRoutes($app)
    {
        Route::get('/api/auth')->middleware(Authenticate::class);
    }

    /**
     * @define-route usesAuthRoutes
     * @test
     */
    public function it_can_authenticate_valid_user()
    {
        $response = $this->get('/api/auth', [
            'Authorization' => "Bearer " . Str::random()
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
}