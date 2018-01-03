<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Proposal;
use PMW\Support\RequestStatus;

class DosenController extends Controller
{

    /**
     * Melihat daftar tim atau proposal yang sedang dalam bimbingan
     *
     * @return void
     */
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

    /**
     * Melihat daftar logbook dari proposal tertentu
     *
     * @param int $proposal
     * @return void
     */
    public function logbook($proposal)
    {
        if(is_null(Proposal::find($proposal)))
            return abort(404);
            
        if(Proposal::find($proposal)->pembimbing()->id != Auth::user()->id)
            return abort(404);

        $logbook = Proposal::find($proposal)->logbook()->paginate(3);

        return view('dosen.pembimbing.logbook', [
            'proposal' => Proposal::find($proposal),
            'daftarlogbook' => $logbook
        ]);
    }

}
