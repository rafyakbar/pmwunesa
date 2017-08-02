<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PMW\User;

class UserController extends Controller
{
    
    public function editProfil(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'id_prodi' => 'required|numeric',
            'alamat_asal' => 'required',
            'alamat_tinggal' => 'required',
            'no_telepon' => 'required|numeric'
        ]);

        User::find(Auth::user()->id)->update([
            'nama' => $request->nama,
            'id_prodi' => $request->id_prodi,
            'alamat_asal' => $request->alamat_asal,
            'alamat_tinggal' => $request->alamat_tinggal,
            'no_telepon' => $request->no_telepon
        ]);

        return back();
    }

    public function gantiPassword(Request $request)
    {
        if(!Hash::check($request->password_lama,Auth::user()->password)){
            $response = ['error' => 1];
        }
        else{
            if($request->password_baru != $request->konfirmasipassword){
                $response = ['error' => 2];
            }
            else{
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->password_baru);
                $user->save();
                $response = ['error' => 0];
            }
        }
    }

}