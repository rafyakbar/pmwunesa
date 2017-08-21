<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Http\Controllers\Controller;
use PMW\Models\Prodi;
use PMW\Models\Proposal;
use PMW\User;

class AdminFakultasController extends Controller
{
    public function daftarProposal()
    {
        return view('admin.fakultas.daftarproposal',[
            'proposal' => Proposal::proposalPerFakultas(Auth::user()->prodi()->jurusan()->id_fakultas)
        ]);
    }
}
