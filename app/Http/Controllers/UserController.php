<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PMW\Models\Fakultas;
use PMW\Models\HakAkses;
use PMW\Mail\RegisterMail;
use PMW\Models\Jurusan;
use PMW\Models\Mahasiswa;
use PMW\Models\Prodi;
use PMW\Support\RequestStatus;
use PMW\User;
use PMW\Events\UserTerdaftar;
use PMW\Mail\PasswordResetMail;

class UserController extends Controller
{

    public function editProfil(Request $request)
    {
        if (Auth::user()->isMahasiswa()) {
            $this->validate($request, [
                'nama' => 'required',
                'id_prodi' => 'required|numeric',
                'alamat_asal' => 'required',
                'alamat_tinggal' => 'required',
                'no_telepon' => 'required|numeric',
                'ipk' => 'required|between:0.0,4.0'
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
            'id_prodi' => $request->id_prodi,
            'alamat_asal' => $request->alamat_asal,
            'alamat_tinggal' => $request->alamat_tinggal,
            'no_telepon' => $request->no_telepon
        ]);

        // Jika user adalah mahasiswa, maka perlu melakukan update
        // nilai ipknya
        if (Auth::user()->isMahasiswa()) {
            Auth::user()->mahasiswa()->update([
                'ipk' => $request->ipk
            ]);
        }

        Session::flash('message', 'Berhasil mengubah profil !');

        return back();
    }

    public function gantiPassword(Request $request)
    {
        if (!Hash::check($request->plama, Auth::user()->password)) {
            return back()->withErrors([
                'plama' => 'Password tidak sama dengan password anda saat ini'
            ]);
        } else {
            if ($request->pbaru != $request->pbaru_confirm) {
                return back()->withErrors([
                    'pbaru' => 'Password tidak sama !'
                ]);
            } elseif ($request->pbaru == Auth::user()->password) {
                return back()->withErrors([
                    'pbaru' => 'Password tidak boleh sama dengan yang lama !'
                ]);
            } else {
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->pbaru);
                $user->save();

                Session::flash('message', 'Berhasil mengubah password !');
                return back();
            }
        }
    }

    public function tambah(Request $request)
    {
        $password = str_random(8);

        $user = User::create([
            'id' => $request->id,
            'email' => $request->email,
            'password' => bcrypt($password),
            'id_prodi' => (in_array('Admin Fakultas',$request->hakakses))?Prodi::where('id_jurusan','=',Jurusan::where('id_fakultas','=',$request->idfakultas)->first()->id)->first()->id:'',
            'request' => true
        ]);

        event(new UserTerdaftar($user, $request->hakakses, $password));

        return back();
    }

    public function editHakAkses(Request $request)
    {
        if (is_null($request->hakakses))
            return back();

        foreach ($request->hakakses as $value) {
            if ($value == 'Ketua Tim')
                $value = 'Anggota';
            if (!User::find($request->id)->hasRole($value)) {
                if ($value == 'Anggota' || $value == 'Ketua Tim') {
                    Mahasiswa::create([
                        'id_pengguna' => $request->id
                    ]);
                }
                User::find($request->id)->hakAksesPengguna()->attach(HakAkses::where('nama', $value)->first(), ['status_request' => RequestStatus::APPROVED]);
            }
        }

        return back();
    }

    public function hapus(Request $request)
    {
        User::find($request->id)->delete();

        return back();
    }

    public function cariMahasiswa(Request $request)
    {
        $nama = $request->nama;

        return User::cariMahasiswaUntukUndanganTim($nama);
    }

    public function cariPembimbing(Request $request)
    {
        $nama = $request->nama;

        return User::cariDosenPembimbing($nama);
    }

    public function cariReviewer(Request $request)
    {
        $nama = $request->nama;

        return User::cari('nama', $nama, HakAkses::REVIEWER);
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:pengguna,email'
        ]);

        $email = $request->email;

        $password = str_random(10);
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($password);
        $user->save();

        Mail::to($email)->send(new PasswordResetMail($user, $password));

        if(Session::has('tab'))
            Session::forget('tab');

        Session::flash('tab', 'reset');

        Session::flash('message', 'Berhasil melakukan reset password. Silahkan cek email');

        return back();
    }

}
