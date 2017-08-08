<?php

namespace PMW\Http\Middleware;

use Closure;
use PMW\Models\HakAkses;
use PMW\User;

class AuthReviewer
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
        if($request->user()->hasRole(HakAkses::REVIEWER))
            return redirect()->route('dashboard');
        return $next($request);
    }
    
}
