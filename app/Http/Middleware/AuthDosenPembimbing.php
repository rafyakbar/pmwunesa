<?php

namespace PMW\Http\Middleware;

use Closure;

class AuthDosenPembimbing
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
        if(!$request->user()->hasRole(User::DOSEN_PEMBIMBING))
            return redirect()->route('dashboard');
            
        return $next($request);
    }
}
