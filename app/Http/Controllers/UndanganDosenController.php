<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Bimbingan;
use PMW\Models\Proposal;
use PMW\Support\RequestStatus;
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
        $proposal = Auth::user()->mahasiswa()->proposal();

        $dosen->bimbingan()->attach($proposal);

        return response()->json([
            'message' => 'Berhasil mengirim undangan !',
            'error' => 0
        ]);
    }

    public function kirimUlang(Request $request)
    {
        $dosen = User::find($request->dosen);
        $proposal = Auth::user()->mahasiswa()->proposal();

        $dosen->bimbingan()->updateExistingPivot($proposal->id, [
            'status_request' => RequestStatus::REQUESTING
        ]);

        return response()->json([
            'message' => 'Berhasil mengirim ulang !',
            'error' => 0
        ]);
    }

    public function hapus(Request $request)
    {
        $dosen = User::find($request->dosen);
        $proposal = Auth::user()->mahasiswa()->proposal();

        $dosen->bimbingan()->detach($proposal);

        return response()->json([
            'message' => 'Berhasil membatalkan dan menghapus undangan !',
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

        $proposal->tambahPembimbing(Auth::user());

        return response()->json([
            'message' => 'Anda telah menjadi pembimbing tim ini !',
            'error' => 0
        ]);
    }

    public function tolak(Request $request)
    {
        $proposal = Proposal::find($request->proposal);

        Auth::user()->bimbingan()->updateExistingPivot($request->proposal, [
            'status_request' => RequestStatus::REJECTED
        ]);

        return response()->json([
            'message' => 'Berhasil menolak undangan !',
            'error' => 0
        ]);
    }

}
