<?php

namespace PMW\Http\Middleware;

use Closure;
use PMW\User;

class AuthKetuaTim
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
        if($request->user()->hak_akses != User::KETUA_TIM)
            return redirect()->route('dashboard');
        return $next($request);
    }
}
