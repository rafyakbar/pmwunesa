<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\User;

class DashboardController extends Controller
{
    
    public function index()
    {
        switch(Auth::user()->role){
            case User::$mahasiswa :
                $this->mahasiswa();
                break;
            case User::$reviewer :
                $this->reviewer();
                break;
            case User::$adminFakultas :
                $this->adminFakultas();
                break;
            default :
                $this->adminUniversitas();
                break;
        }
    }

    public function mahasiswa()
    {
        return view('mahasiswa.dashboard');
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

}
