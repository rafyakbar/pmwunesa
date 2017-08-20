<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PMW\Models\LogBook;
use Illuminate\Support\Facades\Auth;

class LogBookController extends Controller
{

    private $validationArr = [
        'catatan' => 'required',
        'biaya' => 'required|numeric'
    ];

    /**
     * Menambah LogBook
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function tambah(Request $request)
    {

        $this->validate($request,$this->validationArr);

        if ($this->bolehTambahLogBook()) {

            // Menambah LogBook ke database
            $tambah = LogBook::create([
                'catatan' => $request->catatan,
                'biaya' => $request->biaya,
                'id_proposal' => Auth::user()->mahasiswa()->proposal()->id
            ]);
            Session::flash('message', 'Berhasil menambah logbook !');
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
        $this->validate($request, $this->validationArr);

        // Menambah LogBook ke database
        $edit = LogBook::find($request->id)->update([
            'catatan' => $request->catatan,
            'biaya' => $request->biaya,
        ]);

        Session::flash('message','Berhasil mengubah logbook !');
        return redirect()->route('logbook');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hapus(Request $request)
    {
        $logbook = LogBook::find($request->id);

        if(is_null($logbook)){
            return response()->json([
                'message' => 'Anda tidak bisa menghapus logbook tersebut !',
                'type' => 'error'
            ]);
        }

        if($logbook->id_proposal !== Auth::user()->mahasiswa()->proposal()->id){
            return response()->json([
                'message' => 'Anda tidak bisa menghapus logbook tersebut !',
                'type' => 'error'
            ]);
        }

        $logbook->delete();

        return response()->json([
            'message' => 'Berhasil menghapus logbook !',
            'type' => 'success'
        ]);
    }

    private function bolehTambahLogBook()
    {
        return true;
        return (Auth::user()->isKetua() && Auth::user()->mahasiswa()->proposal()->lolos());
    }

}
