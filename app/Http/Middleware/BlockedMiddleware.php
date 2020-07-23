<?php

namespace App\Http\Middleware;

use Closure;

class BlockedMiddleware
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
        if(auth()->user()->job == 'blocked'){
            return $next($request);
        }
        return redirect()->route('home');
    }
}
