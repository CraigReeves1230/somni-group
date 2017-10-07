<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AgentOnly
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
        // if user isn't an agent, redirect back to home page
        if(Auth::guest() || !Auth::user()->agent){
            return redirect('/');
        }

        return $next($request);
    }
}
