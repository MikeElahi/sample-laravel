<?php

namespace WiGeeky\Todo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use WiGeeky\Todo\Models\Task;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route()->hasParameter('task')) {
            abort_if(
                $request->route()->parameter('task') and
                !Task::query()
                    ->where('id', (int) $request->route()->parameter('task'))
                    ->where('user_id', (int) $request->user()->id)
                    ->exists(),
                404
            );
        }

        return $next($request);
    }
}
