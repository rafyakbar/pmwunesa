<?php

namespace PMW\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdminUniversitas
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
        if(Auth::check() && Auth::user()->hak_akses != HakAkses::ADMIN_UNIVERSITAS)
            return redirect()->route('dashboard');
        return $next($request);
    }
}
