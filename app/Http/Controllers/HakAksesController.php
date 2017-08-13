<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Models\HakAkses;
use PMW\Support\RequestStatus;

class HakAksesController extends Controller
{

    public function requestReviewer()
    {
        $reviewer = HakAkses::find(HakAkses::REVIEWER);

        return $this->requestHakAkses($reviewer);
    }

    public function requestDosenPembimbing()
    {
        $pembimbing = HakAkses::find(HakAkses::DOSEN_PEMBIMBING);

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
                $pengguna->hakAksesPengguna()
                    ->detach($hakAkses);
                $pengguna->hakAksesPengguna()
                    ->attach($hakAkses);
            } else {
                $pengguna->hakAksesPengguna()->attach($hakAkses, [
                    'status_request' => RequestStatus::REQUESTING
                ]);
            }
        }
        return response()->json([
            'message' => 'Gagal !',
            'error' => 1
        ]);
    }

    public function terimaRequest(Request $request)
    {
        $pengguna = User::find($request->id_pengguna);
        $hakAkses = HakAkses::find($request->id_hak_akses);
        $permintaan = $pengguna->hakAksesPengguna($hakAkses);

        // Menerima permintaan
        $permintaan->update([
            'status_request' => RequestStatus::APPROVED
        ]);
    }

    public function tolakRequest(Request $request)
    {
        $pengguna = User::find($request->id_pengguna);
        $idHakAkses = HakAkses::find($request->id_hak_akses);

        $pengguna->hakAksesPengguna()->where('id_hak_akses', $idHakAkses->id)->update([
            'status_request' => RequestStatus::REJECTED
        ]);
    }

}
