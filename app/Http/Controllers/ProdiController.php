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
                'id_jurusan'    => $request->id_jurusan
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
        $data->save();

        return back();
    }
}
