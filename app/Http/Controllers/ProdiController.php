<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Prodi;

class ProdiController extends Controller
{
    public function tambah(Request $request)
    {
        foreach (explode(PHP_EOL, $request->nama) as $item){
            Prodi::create([
                'nama'          => $item,
                'id_fakultas'   => $request->id_jurusan
            ]);
        }
    }
}
