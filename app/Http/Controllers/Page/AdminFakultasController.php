<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Facades\ExcelExport;
use PMW\Http\Controllers\Controller;
use PMW\Models\Proposal;

class AdminFakultasController extends Controller
{
    public function daftarProposal($filter)
    {
        return view('admin.fakultas.daftarproposal', [
            'proposal'  => Proposal::proposalPerFakultas(Auth::user()->prodi()->jurusan()->id_fakultas),
            'filter'    => $filter,
            'c'         => 0
        ]);
    }

    public function unduhProposal(Request $request)
    {
        return ExcelExport::unduhProposal(Auth::user()->prodi()->jurusan()->id_fakultas, $request->filter);
    }
}
