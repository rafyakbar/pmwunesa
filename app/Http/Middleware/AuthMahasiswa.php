<?php

namespace PMW\Http\Middleware;

use Closure;
use PMW\User;

class AuthMahasiswa
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
        if($request->user()->hasAnyRole([User::KETUA_TIM, User::ANGGOTA]))
        {
            return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
