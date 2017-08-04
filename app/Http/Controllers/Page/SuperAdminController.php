<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use PMW\Http\Controllers\Controller;
use PMW\Models\Fakultas;
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
            'fakultas' => Fakultas::all()
        ]);
    }

    public function tampilDataProposal()
    {

    }
}
