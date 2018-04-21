<?php

namespace PMW\Http\Controllers\Auth;

use PMW\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');        
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function username()
    {
        return 'id';
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->route('login', [
            'tab' => 'login',
            'loginerr' => trans('auth.failed')
        ]);
    }

}
