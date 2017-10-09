<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PMW\Models\HakAkses;
use PMW\Support\RequestStatus;
use PMW\User;

class HakAksesController extends Controller
{

    public function requestReviewer()
    {
        $reviewer = HakAkses::where('nama', HakAkses::REVIEWER)->first();

        return $this->requestHakAkses($reviewer);
    }

    public function requestDosenPembimbing()
    {
        $pembimbing = HakAkses::where('nama', HakAkses::DOSEN_PEMBIMBING)->first();

        return $this->requestHakAkses($pembimbing);
    }

    /**
     * Melakukan request untuk hak akses tertentu
     * @param  $hakAkses
     * @return Illuminate\Http\JsonResponse
     */
    public function requestHakAkses($hakAkses)
    {
        $pengguna = Auth::user();

        // Jika user telah memiliki hak akses tersebut
        // maka tidak perlu request lagi, buat apa
        if (!$pengguna->hasRole($hakAkses->nama)) {
            // Jika request pernah di tolak, maka cukup melakukan
            // update pada tabel dengan mengubah status request
            if ($pengguna->hakAksesDitolak($hakAkses)) {
                $pengguna->hakAksesPengguna()->updateExistingivot($hakAkses->id ,[
                    'status_request' => RequestStatus::REQUESTING
                ]);
            } else {
                $pengguna->hakAksesPengguna()->attach($hakAkses, [
                    'status_request' => RequestStatus::REQUESTING
                ]);
            }

            Session::flash('message', 'Berhasil melakukan request hak akses !');
            Session::flash('error', false);

            return back();
        }

        Session::flash('message', 'Gagal melakukan request hak akses !');
        Session::flash('error', true);

        return back();
    }

    public function terimaRequest(Request $request)
    {
        $pengguna = User::find($request->id_pengguna);

        $pengguna->hakAksesPengguna()->updateExistingPivot($request->id_hak_akses, [
            'status_request' => RequestStatus::APPROVED
        ], false);

        return back();
    }

    public function tolakRequest(Request $request)
    {
        $pengguna = User::find($request->id_pengguna);

        $pengguna->hakAksesPengguna()->updateExistingPivot($request->id_hak_akses, [
            'status_request' => RequestStatus::REJECTED
        ], false);

        return back();
    }

}
