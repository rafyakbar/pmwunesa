<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Aspek;
use PMW\Models\Laporan;

class ReviewerController extends Controller
{

    public function daftarProposal()
    {
        return view('dosen.reviewer.daftarproposal',[
            'daftarproposal' => Auth::user()->review()
        ]);
    }

    public function daftarProposalFinal()
    {
        return view('dosen.reviewer.daftarproposalfinal',[
            'daftarproposal' => Auth::user()->review()->where('direktori_final','!=','')
        ]);
    }

    public function daftarLaporanKemajuan()
    {
        return view('dosen.reviewer.daftarlaporan',[
            'daftarlaporan' => Laporan::where('jenis',Laporan::KEMAJUAN)
        ]);
    }

    public function daftarLaporanAkhir()
    {
        return view('dosen.reviewer.daftarlaporan',[
            'daftarlaporan' => Laporan::where('jenis',Laporan::AKHIR)
        ]);
    }

    public function lihatNilaiReview($id)
    {
        $proposal = Auth::user()->review()->wherePivot('id',$id)->first();
        $penilaian = $proposal->penilaian();

        return view('dosen.reviewer.nilaiproposal',[
            'penilaian' => $penilaian,
            'proposal' => $proposal
        ]);
    }

    public function tambahReview($id)
    {
        $proposal = Auth::user()->review()->wherePivot('id',$id)->first();

        return view('dosen.reviewer.tambahreview',[
            'proposal' => $proposal,
            'daftarAspek' => Aspek::all()
        ]);
    }

    public function editNilaiReview($id)
    {
        $proposal = Auth::user()->review()->wherePivot('id',$id)->first();
        $penilaian = $proposal->penilaian();

        return view('dosen.reviewer.kelolareview',[
            'penilaian' => $penilaian,
            'daftaraspek' => Aspek::all(),
            'proposal' => $proposal,
            'type' => 'edit'
        ]);
    }

}
