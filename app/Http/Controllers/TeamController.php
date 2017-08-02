<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Proposal;
use PMW\User;

class TeamController extends Controller
{
    
    public function tambahAnggota(Request $request)
    {
        // mendapatkan id dari user yang diminta
        $anggota = User::find($request->id);
        // instance dari ketua tim
        $ketua = User::find(Auth::user()->id);
        // membuat proposal baru
        $proposal = new Proposal();
        // apakah user sudah memiliki proposal sebelumnya
        if($ketua->proposal()->first()){
            // jika user sudah pernah memiliki proposal
            // maka simpan instance-nya
            $proposal = $ketua->proposal()->first();
        }
        $proposal->save();

        // Menambahkan id pengguna dan proposal dalam tabel tim
        $proposal->pengguna()->attach($anggota);
    }

    public function hapusAnggota(Request $request)
    {
        // mendapatkan id dari user yang diminta
        $anggota = User::find($request->id);
        // instance dari user yang sedang aktif (ketua tim)
        $ketua = User::find(Auth::user()->id);
        // proposal dari tim yang diketuai oleh user yang sedang aktif
        $proposal = $ketua->proposal()->first();
        // menghapus anggota dari tim
        $proposal->pengguna()->detach($anggota);
    }

}
