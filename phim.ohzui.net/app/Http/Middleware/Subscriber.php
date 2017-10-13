<?php

namespace App\Http\Middleware;

use Closure;

class Subscriber
{
    public function handle($request, Closure $next)
    {
 
        if ( Auth::check() && Auth::user()->isSubcriber() )
        {
            return $next($request);
        }
 
        return redirect('home');
 
    }
}
