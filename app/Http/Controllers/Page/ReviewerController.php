<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Aspek;

class ReviewerController extends Controller
{

    public function daftarProposal()
    {
        return view('dosen.reviewer.daftarproposal',[
            'daftarproposal' => Auth::user()->review()
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
