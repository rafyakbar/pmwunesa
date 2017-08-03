<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;

class HakAksesController extends Controller
{
    
    public function tambah(Request $request)
    {
        $idRole = $request->id_role;
    }

    public function hapus(Request $request)
    {
        $idRole = $request->id_role;
    }

}
