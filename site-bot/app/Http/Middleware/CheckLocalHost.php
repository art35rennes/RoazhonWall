<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLocalHost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((new Request)->server('SERVER_ADDR') != (new Request)->server('REMOTE_ADDR'))
        {
            return response(501);
        }else{
            return $next($request);
        }

    }
}
