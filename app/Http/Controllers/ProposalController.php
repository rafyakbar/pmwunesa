<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

class ProposalController extends Controller
{

    public function tambah(){
        $validator = Validator::make(request()->all(), [
            'usulan_dana'   =>  'required',
            'judul'         =>  'required',
            'abstrak'       =>  'required',
            'jenis_usaha'   =>  'required',
            'keyword'       =>  'required',
            'direktori'     =>  'required',
        ]);

        if ($validator->fails()){
            redirect()
                ->back()
                ->withErrors($validator->errors());
        }
    }
}
