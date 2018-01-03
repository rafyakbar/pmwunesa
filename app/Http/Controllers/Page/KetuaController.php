<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PMW\Models\LogBook;

/**
 * Class ini berfungsi untuk menampilkan halaman yang hanya bisa
 * diakses oleh ketua tim saja
 * 
 * @author BagasMuharom <bagashidayat@mhs.unesa.ac.id|bagashidayat45@gmail.com>
 * @package PMW\Http\Controllers\Page
 */
class KetuaController extends Controller
{

    /**
     * Menampilkan halaman untuk mengunggah proposal
     *
     * @return Illuminate\View\View
     */
    public function unggahProposal()
    {
        // Jika user tidak bisa melakukan pengunggahan proposal
        // maka akan dialihkan ke halaman detail proposal
        if(!Auth::user()->mahasiswa()->bisaUnggahProposal())
            return redirect()->route('proposal');

        return view('mahasiswa.kelolaproposal');
    }

    /**
     * Menampilkan halaman untuk mengedit proposal
     *
     * @return Illuminate\View\View
     */
    public function editProposal()
    {
        if(!Auth::user()->mahasiswa()->bisaUnggahProposal())
            return redirect()->route('proposal');

        return view('mahasiswa.kelolaproposal', [
            'proposal' => Auth::user()->mahasiswa()->proposal()
        ]);
    }

    /**
     * Menampilkan halaman untuk mengedit logbook
     *
     * @param int $id
     * @return Illuminate\View\View
     */
    public function editLogbook($id)
    {
        $logbook = LogBook::find($id);

        if(!is_null($logbook) && Auth::user()->mahasiswa()->proposal()->id === $logbook->id_proposal) {
            return view('mahasiswa.editlogbook', [
                'logbook' => $logbook
            ]);
        }
        else
            return redirect()->route('logbook');
    }

    /**
     * Halaman untuk mengunggah proposal final
     *
     * @return Illuminate\View\View
     */
    public function unggahProposalFinal()
    {
        return view('mahasiswa.kelolaproposalfinal');
    }

    /**
     * Menampilkan halaman untuk mengedit proposal final
     *
     * @return Illuminate\View\View
     */
    public function editProposalFinal()
    {
        $proposal = Auth::user()->mahasiswa()->proposal();

        return view('mahasiswa.kelolaproposalfinal', [
            'proposal' => $proposal
        ]);
    }

}
