<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\User;
use PMW\Models\Proposal;

class ProposalController extends Controller
{

    private $validationArr = [
        'usulan_dana'   =>  'required|numeric',
        'judul'         =>  'required',
        'abstrak'       =>  'required',
        'jenis_usaha'   =>  'required',
        'keyword'       =>  'required',
    ];

    public function tambah(Request $request)
    {
        $this->validate($request,$this->validationArr);
    }

    /**
     * Mengunggah proposal
     *
     * @param  $file
     * @return void
     */
    public function unggahProposal($file)
    {
        $file->storePubliclyAs('public/proposal',$file->getClientOriginalName());
    }

    public function edit(Request $request)
    {
        $this->validate($request,$this->validationArr);

        $proposal = User::find(Auth::user()->id)->proposal()->first();

        $proposal->update([
            'usulan_dana'   => $request->usulan_dana,
            'judul'         => $request->judul,
            'abstrak'       => $request->abstrak,
            'jenis_usaha'   => $request->jenis_usaha,
            'keyword'       => $request->keyword,
            'direktori'     => $request->direktori
        ]);
    }

    public function unduh(Request $request)
    {
        $proposal = Proposal::find($request->id);

        // proses unduh
        return response()->download(storage_path('app/public/proposal/' . $proposal->direktori));
    }

}
