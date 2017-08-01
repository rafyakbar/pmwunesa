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
        $user = User::find(Auth::user()->id);

        $proposal = new Proposal();
        // Jika user sudah memiliki proposal
        if($user->proposal()->first()){
            $proposal = $user->proposal()->first();
        }
        $proposal->save();

        // Menambahkan id pengguna dan proposal dalam tabel tim
        $proposal->user()->attach($anggota);
    }

    public function hapusAnggota(Request $request)
    {

    }

}
