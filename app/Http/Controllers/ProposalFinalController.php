<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Support\FileHandler;
use PMW\User;
use PMW\Models\Proposal;

class ProposalFinalController extends Controller
{

    /**
     * Format atau ekstensi file yang diperbolehkan untuk diunggah
     *
     * @var array
     */
    private $validExtension = [
        'pdf', 'doc', 'docx'
    ];

    private $dir = 'proposal/final';

    use FileHandler;

    public function unggah(Request $request)
    {
        if($this->bolehUnggah())
        {
            if($this->berkasValid($request->file('berkas')))
            {
                $proposal = Auth::user()->mahasiswa()->proposal();

                $berkas = $this->unggahBerkas($request->file('berkas'));

                $proposal->update([
                    'direktori_final' => $berkas
                ]);
            }
        }
    }

    public function hapus(Request $request)
    {

    }

    public function unduh(Request $request)
    {
        $proposal = Proposal::find($request->id);

        if(Auth::user()->isMahasiswa())
            $proposal = Auth::user()->mahasiswa()->proposal();

        // proses unduh
        return response()->download(storage_path('app/public/' . $this->dir . '/' . $proposal->direktori_final));
    }

}
