<?php

namespace PMW\Http\Controllers\Auth;

use PMW\User;
use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use PMW\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $generatedPassword;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->registered($request,$user);

        Session::flash('message','Berhasil Mendaftar !');

        return back();
    }

    /**
     * Melakukan pengiriman email ke pengguna
     *
     * @param Request $request
     * @param Pengguna $user
     * @return void
     */
    protected function registered(Request $request, $user)
    {
        Mail::to($user->email)->send(new RegisterMail($user,$this->generatedPassword));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id' => 'required|min:12|unique:pengguna|numeric',
            'email' => 'required|unique:pengguna|email' 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \PMW\User
     */
    protected function create(array $data)
    {
        $this->generatedPassword = str_random(8);
        return User::create([
            'id' => $data['id'],
            'email' => $data['email'],
            'password' => bcrypt($this->generatedPassword)
        ]);
    }
}
