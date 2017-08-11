<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Aspek;

class AspekController extends Controller
{
    public function tambah(Request $request)
    {
        foreach (explode(PHP_EOL, $request->nama) as $item) {
            Aspek::create([
                'nama' => $item
            ]);
        }

        return back();
    }

    public function hapus(Request $request)
    {
        Aspek::where('id', $request->id)->delete();

        return back();
    }

    public function edit(Request $request)
    {
        $data = Aspek::find($request->id);
        $data->nama = $request->nama;
        $data->save();

        return back();
    }
}
