<?php

namespace PMW\Http\Middleware;

use Closure;
use PMW\Models\HakAkses;

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
        if($request->user()->hasAnyRole([HakAkses::KETUA_TIM, HakAkses::ANGGOTA]))
        {
            return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
