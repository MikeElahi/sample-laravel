<?php

namespace WiGeeky\Todo\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WiGeeky\Todo\Todo;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @throws AuthenticationException
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            return $next($request);
        }

        if (empty($request->bearerToken())) {
            throw new AuthenticationException();
        }
        $user = Todo::$authModel::query()
            ->where('token', $request->bearerToken())
            ->firstOr(['token'], function () {
                throw new AuthenticationException();
            });
        // Automatically mark the user as logged in
        Auth::login($user);

        return $next($request);
    }
}
