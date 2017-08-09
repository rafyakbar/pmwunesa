<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Jurusan;

class JurusanController extends Controller
{
    public function tambah(Request $request)
    {
        foreach (explode(PHP_EOL, $request->nama) as $item){
            Jurusan::create([
                'nama'          => $item,
                'id_fakultas'   => $request->id_fakultas
            ]);
        }
    }
}
