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
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            throw new AuthenticationException;
        }

        Todo::$authModel::query()
            ->where('token', $request->header('Authorization'))
            ->firstOr(['token'], function () {
                throw new AuthenticationException;
            });

        return $next($request);
    }
}