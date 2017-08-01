<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function editProfil(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
        ]);
    }

}
