<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use PMW\Http\Controllers\Controller;
use PMW\Models\Fakultas;
use PMW\Models\Jurusan;
use PMW\Models\Prodi;
use PMW\User;

class SuperAdminController extends Controller
{
    public function tampilDataPengguna()
    {
        return view('admin.super.daftarpengguna', [
            'user' => User::all()
        ]);
    }

    public function tampilDataFakultas()
    {
        return view('admin.super.daftarfakultas', [
            'fakultas'  => Fakultas::all(),
            'jurusan'   => Jurusan::all(),  //hanya untuk tes
            'prodi'     => Prodi::all()     //hanya untuk tes
        ]);
    }

    public function tampilDataProposal()
    {

    }
}
