<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!isset(\getallheaders()['Api-Token'])) {
            return Response::json(['error'=>'Please set api token']);
        }

        if (\getallheaders()['Api-Token'] != \getenv('API_TOKEN')) {
            return Response::json(['error'=>'wrong api token']);
        }
        return $next($request);
    }
}
