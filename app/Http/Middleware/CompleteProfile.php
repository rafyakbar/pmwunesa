<?php

namespace PMW\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CompleteProfile
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
        if(empty($request->user()->no_telepon)){
            Session::flash('message','Harap melengkapi profil anda terlebih dahulu !');
            return redirect()->route('pengaturan');
        }

        return $next($request);
    }
}
