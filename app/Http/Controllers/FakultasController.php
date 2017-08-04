<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Fakultas;

class FakultasController extends Controller
{
    public function tambah(Request $request)
    {
        foreach (explode(PHP_EOL, $request->fakultas) as $item){
            Fakultas::create([
               'nama' => $item
            ]);
        }
    }
}
