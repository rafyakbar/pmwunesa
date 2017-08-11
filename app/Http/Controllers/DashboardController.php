<?php

namespace PMW\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use PMW\Models\HakAkses;
use PMW\Support\RequestStatus;

class DashboardController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->isSuperAdmin())
            return $this->superAdmin();
        else if(Auth::user()->isAdminUniversitas())
            return $this->adminUniversitas();
        else if(Auth::user()->isAdminFakultas())
            return $this->adminFakultas();
        else if(Auth::user()->isDosenPembimbing())
            return $this->dosen();
        else if(Auth::user()->isReviewer())
            return $this->reviewer();
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
        return view('dosen.reviewer.dashboard');
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
