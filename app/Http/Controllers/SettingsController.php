<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PMW\User;

class SettingsController extends Controller
{
    
    /**
     * Mengganti password/kata sandi dari user yang sedang login
     *
     * @param Request $request
     * @return void
     */
    public function gantiPassword(Request $request)
    {
        // if(!Hash::check($request->plama,Auth::user()->password)){
        //     $response = ['error' => 1];
        // }
        // else{
        //     if($request->pbaru != $request->konfirmasipbaru){
        //         $response = ['error' => 2];
        //     }
        //     else{
        //         $user = User::find(Auth::user()->id);
        //         $user->password = Hash::make($request->pbaru);
        //         $user->save();
        //         $response = ['error' => 0];
        //     }
        // }
        
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->baru);
        $user->save();

        return back();
    }

}
