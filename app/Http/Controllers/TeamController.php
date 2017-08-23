<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Mahasiswa;

class TeamController extends Controller
{

    public function hapusAnggota(Request $request)
    {
        $anggota = User::find($request->anggota);

        if(!is_null($anggota)){
            Mahasiswa::where('id_pengguna',$anggota->id)
                ->delete();

            return response()->json([
                'message' => 'Berhasil menghapus anggota !',
                'type' => 'success'
            ]);
        }

        return response()->json([
            'message' => 'Tidak bisa menghapus anggota !',
            'type' => 'error'
        ]);
    }

}
