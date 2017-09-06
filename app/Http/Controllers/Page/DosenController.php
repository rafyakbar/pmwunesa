<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Proposal;
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

    public function logbook($proposal)
    {
        $logbook = Proposal::find($proposal)->logbook()->paginate(3);

        return view('dosen.pembimbing.logbook', [
            'proposal' => Proposal::find($proposal),
            'daftarlogbook' => $logbook
        ]);
    }

}
