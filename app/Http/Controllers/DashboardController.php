<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\User;
use PMW\Models\UndanganTim;

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
        else if(Auth::user()->hasRole(User::REVIEWER))
            return $this->reviewer();
        else if(Auth::user()->hasRole(User::DOSEN_PEMBIMBING))
            return $this->dosenPembimbing();
        else
            return $this->mahasiswa();
    }

    public function mahasiswa()
    {
        return view('mahasiswa.dashboard',[
            'undangan' => Auth::user()->mahasiswa()->undanganTimAnggota(),
        ]);
    }

    public function reviewer()
    {
        return view('reviewer.dashboard');
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

    public function dosenPembimbing()
    {
        return view('pembimbing.dashboard');
    }

}
