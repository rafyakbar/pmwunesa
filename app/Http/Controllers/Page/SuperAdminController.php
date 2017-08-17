<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use PMW\Http\Controllers\Controller;
use PMW\Models\Aspek;
use PMW\Models\Fakultas;
use PMW\Models\HakAkses;
use PMW\Models\Jurusan;
use PMW\Models\Pengaturan;
use PMW\Models\Prodi;
use PMW\Models\Proposal;
use PMW\Support\RequestStatus;
use PMW\User;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function pengaturan()
    {
        return view('admin.super.pengaturan',[
            'pengaturan'=> Pengaturan::all(),
            'aspek'     => Aspek::all()
        ]);
    }

    public function tampilDataPengguna()
    {
        return view('admin.super.daftarpengguna', [
            'user'      => User::orderBy('nama')->get(),
            'hak_akses' => HakAkses::orderBy('id')->get()
        ]);
    }

    public function tampilDataFakultas()
    {
        return view('admin.super.daftarfakultas', [
            'fakultas' => Fakultas::orderBy('nama')->get()
        ]);
    }

    public function tampilDataJurusan()
    {
        return view('admin.super.daftarjurusan', [
            'jurusan'   => Jurusan::orderBy('id_fakultas')->orderBy('nama')->get(),
            'fakultas'  => Fakultas::orderBy('nama')->get()
        ]);
    }

    public function tampilDataProdi()
    {
        return view('admin.super.daftarprodi', [
            'prodi'     => Prodi::orderBy('id_jurusan')->orderBy('nama')->get(),
            'jurusan'   => Jurusan::orderBy('nama')->get()
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
        return view('admin.super.daftarrequesthakakses',['pengguna' => HakAkses::permintaanHakAkses()]);
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
