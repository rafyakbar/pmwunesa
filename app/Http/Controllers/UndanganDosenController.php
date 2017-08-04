<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Bimbingan;
use PMW\Models\Proposal;
use PMW\User;

class UndanganDosenController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function kirimUndangan(Request $request)
    {
        $dosen = User::find($request->dosen);
        $proposal = Auth::user()->proposal();

        $dosen->bimbimngan()->attach($proposal,[
            'status_request' => Bimbingan::REQUESTING
        ]);

        return response()->json([
            'message' => 'Berhasil mengirim undangan !',
            'error' => 0
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function terimaUndangan(Request $request)
    {
        $proposal = Proposal::find($request->proposal);

        $proposal->bimbingan()->first()->update([
            'status_request' => Bimbingan::APPROVED
        ]);

        return response()->json([
            'message' => 'Anda telah menjadi pembimbing tim ini !',
            'error' => 0
        ]);
    }

}
