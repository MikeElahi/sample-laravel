<?php

namespace WiGeeky\Todo\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use WiGeeky\Todo\Todo;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty($request->bearerToken())) {
            throw new AuthenticationException;
        }
        Todo::$authModel::query()
            ->where('token', $request->bearerToken())
            ->firstOr(['token'], function () {
                throw new AuthenticationException;
            });

        return $next($request);
    }
}