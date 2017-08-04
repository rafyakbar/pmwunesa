<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Models\HakAkses;
use PMW\Support\RequestStatus;

class HakAksesController extends Controller
{

    public function requestHakAkses(Request $request)
    {
        $hakAkses = HakAkses::find($request->hak_akses);
        $pengguna = Auth::user();

        // Jika user telah memiliki hak akses tersebut
        // maka tidak perlu request lagi, buat apa
        if (!$pengguna->hasRole($hakAkses->nama)) {
            // Jika request pernah di tolak, maka cukup melakukan
            // update pada tabel dengan mengubah status request
            if ($pengguna->hakAksesPengguna()
                ->where('id_hak_akses', $hakAkses->id)
                ->where('status_request', RequestStatus::REJECTED)) {
                $pengguna->hakAksesPengguna()
                    ->where('id_hak_akses', $hakAkses->id)
                    ->update([
                        'status_request' => RequestStatus::REQUESTING
                    ]);
            } else {
                $pengguna->hakAksesPengguna()->attach($hakAkses, [
                    'status_request' => RequestStatus::REQUESTING
                ]);
            }
        }
    }

    public function terimaRequest(Request $request)
    {
        $pengguna = User::find($request->id_pengguna);
        $hakAkses = HakAkses::find($request->id_hak_akses);
        $permintaan = $pengguna->hakAksesPengguna()->where('id_hak_akses', $hakAkses->id);

        // Menerima permintaan
        $permintaan->update([
            'status_request' => RequestStatus::APPROVED
        ]);
    }

    public function tolakRequest(Request $request)
    {
        $pengguna = User::find($request->id_pengguna);
        $idHakAkses = HakAkses::find($request->id_hak_akses);

        $pengguna->hakAksesPengguna()->where('id_hak_akses',$idHakAkses->id)->update([
            'status_request' => RequestStatus::REJECTED
        ]);
    }

}
