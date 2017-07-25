<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Fase2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->id_area == 2 || Auth::user()->id_area == 5 || Auth::user()->id_area == 6 ||  Auth::user()->id_area == 7 || Auth::user()->id_area == 8)  {
            return redirect('/login');
        }
        
        return $next($request);
    }
}
