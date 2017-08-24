<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{

    public function infoTim()
    {
        $view = view('mahasiswa.infotim');

        if(Auth::user()->mahasiswa()->punyaTim() && Auth::user()->mahasiswa()->proposal()->punyaPembimbing())
            $view->with('pembimbing', Auth::user()->mahasiswa()->proposal()->pembimbing());

        return $view;
    }

    public function laporan()
    {
        $view = view('mahasiswa.laporan');

        if(!is_null(Auth::user()->mahasiswa()->proposal()->laporanKemajuan()))
            $view->with('laporankemajuan', Auth::user()->mahasiswa()->proposal()->laporanKemajuan());

        if(!is_null(Auth::user()->mahasiswa()->proposal()->laporanAkhir()))
            $view->with('laporanakhir', Auth::user()->mahasiswa()->proposal()->laporanAkhir());

        return $view;
    }

}
