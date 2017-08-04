<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PMW\Models\LogBook;
use Illuminate\Support\Facades\Auth;

class LogBookController extends Controller
{

    /**
     * @var \PMW\Models\Proposal
     */
    private $proposal;

    private $validationArr = [
        'catatan' => 'required|min:100',
        'biaya'=> 'required'
        ];

    /**
     * Menginisialisasi proposal
     *
     * LogBookController constructor.
     */
    public function __construct()
    {
        $this->proposal = Auth::user()->proposal();
    }

    /**
     * Menambah LogBook
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function tambah(Request $request)
    {
        
        $this->validate($request,$this->validationArr);

        if($this->bolehTambahLogBook()) {

            // Menambah LogBook ke database
            $tambah = Auth::user()->proposal()->logbook()->create([
                'catatan' => $request->catatan,
                'biaya' => $request->biaya,
                'id_proposal' => $this->proposal->id
            ]);
            if (is_null($tambah)) {
                Session::flash('message', 'Gagal menambah Logbook. Coba beberapa saat lagi !');
                return back()->withInput();
            }
            return redirect()->route('logbook');
        }

        Session::flash('message', 'Anda tidak bisa menambah logbook !');
        return back()->withInput();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        $this->validate($request,$this->validationArr);

        // Menambah LogBook ke database
        $edit = LogBook::find($request->id)->update([
            'catatan' => $request->catatan,
            'biaya' => $request->biaya,
        ]);
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hapus(Request $request)
    {
        $logbook = LogBook::find($request->id);
        $logbook->delete();

        return back();
    }

    private function bolehTambahLogBook()
    {
        return (Auth::user()->isKetua() && Auth::user()->proposal()->lolos);
    }

}
