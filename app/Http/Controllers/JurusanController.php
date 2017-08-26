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
                'nama' => $item
            ]);
        }

        return back();
    }

    public function hapus(Request $request)
    {
        Jurusan::where('id', $request->id)->delete();

        return back();
    }

    public function edit(Request $request)
    {
        $data = Jurusan::find($request->id);
        $data->nama = $request->nama;
        $data->id_fakultas = $request->id_fakultas;
        $data->save();

        return back();
    }

    public function daftarBerdasarkanFakultas(Request $request)
    {
        $jurusan = Jurusan::where('id_fakultas', $request->fakultas)->get();

        return response()->json($jurusan);
    }
}
