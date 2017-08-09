<?php

namespace PMW\Http\Middleware;

use Closure;
use PMW\Models\HakAkses;
use Illuminate\Support\Facades\Auth;

class AuthAdminFakultas
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
        if(Auth::check() && Auth::user()->hasRole(HakAkses::ADMIN_FAKULTAS))
            return redirect()->route('dashboard');
        return $next($request);
    }
}
