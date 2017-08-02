<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;

class ProposalFinalController extends Controller
{
    
    public function unggah(Request $request)
    {
        return $request->file->storePubliclyAs('public',$request->file->getClientOriginalName());
    }

    public function hapus(Request $request)
    {
        
    }

    public function unduh(Request $request)
    {
        $proposal = Proposal::find($request->id);

        // proses unduh
        return response()->download(storage_path('app/public/proposal/' . $proposal->direktori));
    }

}
