<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PMW\Models\LogBook;

class KetuaController extends Controller
{

    public function undangDosen()
    {
        return view('mahasiswa.undangdosen');
    }

    public function unggahProposal()
    {
        if(!Auth::user()->mahasiswa()->bisaUnggahProposal())
            return redirect()->route('proposal');

        if(Auth::user()->mahasiswa()->punyaProposal())
            return redirect()->route('edit.proposal');

        return view('mahasiswa.kelolaproposal');
    }

    public function editProposal()
    {
        if(!Auth::user()->mahasiswa()->bisaUnggahProposal())
            return redirect()->route('proposal');

        return view('mahasiswa.kelolaproposal', [
            'proposal' => Auth::user()->mahasiswa()->proposal()
        ]);
    }

    public function editLogbook($id)
    {
        $logbook = LogBook::find($id);
        if(!is_null($logbook) && Auth::user()->mahasiswa()->proposal()->id === $logbook->id_proposal){
            return view('mahasiswa.editlogbook', [
                'logbook' => $logbook
            ]);
        }
        else
            return redirect()->route('logbook');
    }

}
