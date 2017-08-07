<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PMW\Models\HakAkses;
use PMW\User;

class UserController extends Controller
{
    
    public function editProfil(Request $request)
    {
        if(Auth::user()->hasAnyRole([User::KETUA_TIM,User::ANGGOTA])){
            $this->validate($request,[
                'nama' => 'required',
                'id_prodi' => 'required|numeric',
                'alamat_asal' => 'required',
                'alamat_tinggal' => 'required',
                'no_telepon' => 'required|numeric',
                'ipk' => 'required'
            ]);
        }
        else
        {
            $this->validate($request,[
                'nama' => 'required',
                'id_prodi' => 'required|numeric',
                'alamat_asal' => 'required',
                'alamat_tinggal' => 'required',
                'no_telepon' => 'required|numeric'
            ]);
        }

        Auth::user()->update([
            'nama' => $request->nama,
            //'id_prodi' => $request->id_prodi,
            'alamat_asal' => $request->alamat_asal,
            'alamat_tinggal' => $request->alamat_tinggal,
            'no_telepon' => $request->no_telepon
        ]);

        if(Auth::user()->hasAnyRole([User::KETUA_TIM,User::ANGGOTA])){
            Auth::user()->mahasiswa()->update([
                'ipk' => $request->ipk
            ]);
        }

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

    public function tambahUser(Request $request)
    {

    }

    public function cariMahasiswa(Request $request)
    {
        $nama = $request->nama;

        return User::cari('nama',$nama,[User::KETUA_TIM,User::ANGGOTA]);
    }

    public function cariDosen(Request $request)
    {
        $nama = $request->nama;

        return User::cari('nama',$nama,User::DOSEN_PEMBIMBING);
    }

    public function cariReviewer(Request $request)
    {
        $nama = $request->nama;

        return User::cari('nama',$nama,User::REVIEWER);
    }

}
