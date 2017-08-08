<?php

namespace PMW\Http\Middleware;

use Closure;
use PMW\Models\HakAkses;

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
        if($request->user()->hasRole(HakAkses::ADMIN_FAKULTAS))
            return redirect()->route('dashboard');
        return $next($request);
    }
}
