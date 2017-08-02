<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use PMW\Models\LogBook;
use PMW\User;
use Carbon\Carbon;

class LogBookController extends Controller
{

    private $proposal;

    private $validationArr = [
        'catatan' => 'required|min:100',
        'biaya'=> 'required'
        ];

    public function __construct()
    {
        $this->proposal = User::find(Auth::user()->id)->proposal()->first();
    }

    public function ketuaPage()
    {
        return view('mahasiswa.logbook');
    }

    public function tambah(Request $request)
    {
        
        $this->validate($request,$this->validationArr);

        // Menambah LogBook ke database
        $tambah = LogBook::create([
            'catatan' => $request->catatan,
            'biaya' => $request->biaya,
            'id_proposal' => $this->proposal->id
        ]);
        if(is_null($tambah))
        {
            Session::flash('message','Gagal menambah Logbook. Coba beberapa saat lagi !');
            return back()->withInput();
        }
        return back();
    }

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

    public function hapus(Request $request)
    {
        $logbook = LogBook::find($request->id);
        $logbook->delete();

        return back();
    }

}
