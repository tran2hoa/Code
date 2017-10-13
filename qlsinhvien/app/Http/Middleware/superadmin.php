<?php

namespace App\Http\Middleware;

use Closure;

class superadmin
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
      if( Auth::check() && Auth::user()->isSuperAdmin()){
          return $next($request);
      }
      return redirect('home');
    }
}
