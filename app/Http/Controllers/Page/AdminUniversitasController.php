<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use PMW\Http\Controllers\Controller;
use PMW\Models\Fakultas;
use PMW\Models\Proposal;
use PMW\Facades\ExcelExport;

class AdminUniversitasController extends Controller
{
    public function daftarProposal(Request $request)
    {
        $nama_fakultas = ucwords(str_replace('_', ' ', $request->fakultas));
        $proposal = ($request->fakultas == 'semua_fakultas') ? Proposal::all() : Proposal::proposalPerFakultas(Fakultas::where('nama', $nama_fakultas)->first()->id);
        return view('admin.univ.daftarproposal', [
            'proposal' => $proposal,
            'daftar_fakultas' => Fakultas::all(),
            'fakultas' => $request->fakultas,
            'lolos' => $request->lolos,
            'c' => 0
        ]);
    }

    public function unduhProposal(Request $request)
    {
        $nama_fakultas = ucwords(str_replace('_', ' ', $request->fakultas));
        $fakultas = Fakultas::where('nama', $nama_fakultas)->first();
        return ExcelExport::unduhProposal((is_null($fakultas)) ? $fakultas : $fakultas->id, $request->lolos);
    }
}