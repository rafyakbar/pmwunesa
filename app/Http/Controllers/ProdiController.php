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
                'nama'          => $item
            ]);
        }

        return back();
    }

    public function hapus(Request $request)
    {
        Prodi::where('id', $request->id)->delete();

        return back();
    }

    public function edit(Request $request)
    {
        $data = Prodi::find($request->id);
        $data->nama = $request->nama;
        $data->id_jurusan = $request->id_jurusan;
        $data->save();

        return back();
    }

    public function daftarBerdasarkanJurusan(Request $request)
    {
        $prodi = Prodi::where('id_jurusan',$request->jurusan)->get();

        return response()->json($prodi);
    }
}
