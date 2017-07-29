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
    
    private function validasi(Request $request)
    {
        $validate = Validator::make($request,[
            'catatan' => 'required|min:100',
            'biaya'=> 'required'
        ]);

        return $validate;
    }

    public function tambah(Request $request)
    {
        
        $validate = $this->validasi($request);

        if(!$validate->fails())
        {
            // Mendapatkan proposal dari tim
            $proposal = User::find(Auth::user()->id)->tim()->proposal();
            // Menambah LogBook ke database
            $tambah = LogBook::create([
                'catatan' => $request->catatan,
                'biaya' => $request->biaya
            ]);
            if(is_null($tambah))
            {
                Session::flash('message','Gagal menambah Logbook. Coba beberapa saat lagi !');
                return back()->withInput();
            }
            return back();
        }

        return back()->withInput()->withErrors($validate);
    }

    public function edit(Request $request)
    {
        $validate = $this->validasi($request);

        if(!$validate->fails())
        {
            // Mendapatkan proposal dari tim
            $proposal = User::find(Auth::user()->id)->tim()->proposal();
            // Menambah LogBook ke database
            $tambah = LogBook::update([
                'catatan' => $request->catatan,
                'biaya' => $request->biaya
            ]);
            return back();
        }

        return back()->withInput()->withErrors($validate);
    }

    public function hapus(Request $request)
    {

    }

}
