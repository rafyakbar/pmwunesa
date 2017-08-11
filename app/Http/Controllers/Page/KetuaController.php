<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KetuaController extends Controller
{

    public function undangDosen()
    {
        return view('mahasiswa.undangdosen');
    }

    public function editProposal()
    {
        return view('mahasiswa.editproposal',[
            'proposal' => Auth::user()->proposal()
        ]);
    }

}
