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

    public function unggahProposal()
    {
        if(Auth::user()->mahasiswa()->punyaProposal())
            return redirect()->route('edit.proposal');

        return view('mahasiswa.kelolaproposal');
    }

    public function editProposal()
    {
        return view('mahasiswa.kelolaproposal',[
            'proposal' => Auth::user()->mahasiswa()->proposal()
        ]);
    }

}
