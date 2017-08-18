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

        if(Auth::user()->mahasiswa()->proposal()->punyaPembimbing())
            $view->with('pembimbing', Auth::user()->mahasiswa()->proposal()->pembimbing());

        return $view;
    }
}
