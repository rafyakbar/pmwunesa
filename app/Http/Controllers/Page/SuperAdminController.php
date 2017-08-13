<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use PMW\Http\Controllers\Controller;
use PMW\Models\Aspek;
use PMW\Models\Fakultas;
use PMW\Models\HakAkses;
use PMW\Models\Jurusan;
use PMW\Models\Prodi;
use PMW\Models\Proposal;
use PMW\Support\RequestStatus;
use PMW\User;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function tampilDataPengguna()
    {
        return view('admin.super.daftarpengguna', [
            'user' => User::orderBy('nama')->get()
        ]);
    }

    public function tampilDataFakultas()
    {
        return view('admin.super.daftarfakultas', [
            'fakultas' => Fakultas::all(),
            'jurusan' => Jurusan::all(),
            'prodi' => Prodi::all()
        ]);
    }

    public function tampilDataAspek()
    {
        return view('admin.super.daftaraspek', [
            'aspek' => Aspek::all()
        ]);
    }

    public function tampilDataProposal()
    {
        return view('admin.super.daftarproposal', [
            'proposal' => Proposal::all()
        ]);
    }

    public function tampilRequestHakAkses(Request $request)
    {
        return view('admin.super.daftarrequesthakakses',['pengguna' =>
            DB::table('pengguna')
                ->rightJoin(DB::raw('
                 (
                    SELECT
                     id_pengguna,
                     nama AS hakakses,
                     id_hak_akses
                    FROM hak_akses_pengguna
                     LEFT JOIN hak_akses ON hak_akses_pengguna.id_hak_akses = hak_akses.id
                    WHERE hak_akses_pengguna.status_request = \'Requesting\'
                 ) AS status
                '), function ($join){
                    $join->on('status.id_pengguna', '=', 'pengguna.id');
                })
                ->select('id_pengguna', 'nama', 'hakakses', 'id_hak_akses')
                ->orderBy('nama')
                ->get()
        ]);
    }

    public function editReviewer($idproposal)
    {
        return view('admin.super.setreviewer',[
            'daftarreviewer' => HakAkses::where('nama',HakAkses::REVIEWER)->first()->pengguna()->get(),
            'proposal' => Proposal::find($idproposal),
            'oldreviewer' => [
                'tahap1' => Proposal::where('id', $idproposal)->first()->reviewer()->wherePivot('tahap',1),
                'tahap2' => Proposal::where('id', $idproposal)->first()->reviewer()->wherePivot('tahap',2)
            ]
        ]);
    }

}
