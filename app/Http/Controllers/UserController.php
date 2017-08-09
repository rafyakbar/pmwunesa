<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PMW\Models\HakAkses;
use PMW\Mail\RegisterMail;
use PMW\Models\Mahasiswa;
use PMW\User;

class UserController extends Controller
{

    public function editProfil(Request $request)
    {
        if (Auth::user()->hasAnyRole([HakAkses::KETUA_TIM, HakAkses::ANGGOTA])) {
            $this->validate($request, [
                'nama' => 'required',
                'id_prodi' => 'required|numeric',
                'alamat_asal' => 'required',
                'alamat_tinggal' => 'required',
                'no_telepon' => 'required|numeric',
                'ipk' => 'required'
            ]);
        } else {
            $this->validate($request, [
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

        if (Auth::user()->hasAnyRole([HakAkses::KETUA_TIM, HakAkses::ANGGOTA])) {
            Auth::user()->mahasiswa()->update([
                'ipk' => $request->ipk
            ]);
        }

        return back();
    }

    public function gantiPassword(Request $request)
    {
        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            $response = ['error' => 1];
        } else {
            if ($request->password_baru != $request->konfirmasipassword) {
                $response = ['error' => 2];
            } else {
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->password_baru);
                $user->save();
                $response = ['error' => 0];
            }
        }
    }

    public function tambah(Request $request)
    {
        $password = str_random(8);

        User::create([
            'id'        => $request->id,
            'email'     => $request->email,
            'password'  => bcrypt($password),
            'request'   => true
        ]);

        foreach ($request->hakakses as $value){
            if ($value == 'anggota'){
                Mahasiswa::create([
                    'id_pengguna' => $request->id
                ]);
            }
            User::find($request->id)->hakAksesPengguna()->attach(HakAkses::where('nama',HakAkses::SUPER_ADMIN)->first(), ['status_request' => $value]);
        }

        Mail::to($request->email)->send(new RegisterMail(User::find($request->id), $password));
    }

    public function cariMahasiswa(Request $request)
    {
        $nama = $request->nama;

        return User::cari('nama', $nama, [HakAkses::KETUA_TIM, HakAkses::ANGGOTA]);
    }

    public function cariDosen(Request $request)
    {
        $nama = $request->nama;

        return User::cari('nama', $nama, HakAkses::DOSEN_PEMBIMBING);
    }

    public function cariReviewer(Request $request)
    {
        $nama = $request->nama;

        return User::cari('nama', $nama, HakAkses::REVIEWER);
    }

}
