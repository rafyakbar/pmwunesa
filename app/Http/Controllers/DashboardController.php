<?php

namespace PMW\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use PMW\Support\RequestStatus;
use PMW\User;

class DashboardController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->hasRole(User::SUPER_ADMIN))
            return $this->superAdmin();
        else if(Auth::user()->hasRole(User::ADMIN_UNIVERSITAS))
            return $this->adminUniversitas();
        else if(Auth::user()->hasRole(User::ADMIN_FAKULTAS))
            return $this->adminFakultas();
        else if(Auth::user()->isDosen())
            return $this->dosen();
        else
            return $this->mahasiswa();
    }

    public function mahasiswa()
    {
        return view('mahasiswa.dashboard',[
            'undangan' => Auth::user()->mahasiswa()->undanganTimAnggota(),
        ]);
    }

    public function dosen()
    {
        return view('dosen.dashboard',[
            'undangan' => Auth::user()->bimbingan()->where('status_request',RequestStatus::REQUESTING)
        ]);
    }

    public function adminFakultas()
    {
        return view('admin.fakultas.dashboard');
    }

    public function adminUniversitas()
    {
        return view('admin.univ.dashboard');
    }

    public function superAdmin()
    {
        return view('admin.super.dashboard');
    }

}
