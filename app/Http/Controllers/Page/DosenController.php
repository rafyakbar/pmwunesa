<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PMW\Support\RequestStatus;

class DosenController extends Controller
{

    public function bimbingan()
    {
        $daftarProposal = Auth::user()->bimbingan(RequestStatus::APPROVED)
            ->whereNotNull('judul')
            ->paginate(15);

        $jumlahProposalKosong = Auth::user()->bimbingan(RequestStatus::APPROVED)
            ->whereNull('judul')
            ->count();

        return view('dosen.pembimbing.bimbingan', [
            'daftarProposal' => $daftarProposal,
            'jumlahProposalKosong' => $jumlahProposalKosong
        ]);
    }

}
