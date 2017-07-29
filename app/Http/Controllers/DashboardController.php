<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\User;

class DashboardController extends Controller
{
    
    public function index()
    {
        switch(Auth::user()->hak_akses){
            case User::KETUA_TIM :
                $this->ketuaTim();
                break;
            case User::REVIEWER :
                $this->reviewer();
                break;
            case User::ADMIN_FAKULTAS :
                $this->adminFakultas();
                break;
            default :
                $this->adminUniversitas();
                break;
        }
    }

    public function ketuaTim()
    {
        return 'mahasiswa';
        return view('mahasiswa.dashboard');
    }

    public function reviewer()
    {
        return 'reviewer';
        return view('reviewer.dashboard');
    }

    public function adminFakultas()
    {
        return 'adminfakultas';
        return view('admin.fakultas.dashboard');
    }

    public function adminUniversitas()
    {
        return 'adminuniv';
        return view('admin.univ.dashboard');
    }

}
