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

    public function tambahCsv(Request $request)
    {
        $this->validate($request,[
            'csv' => 'required',
            'splitter' => 'required|max:1'
        ]);

        $file = fopen($request->file('csv')->getRealPath(),'r');
        $jumlah = 0;
        while(!feof($file))
        {
            $row = fgetcsv($file,0,$request->splitter);
            Jurusan::create([
                'nama' => $row[0],
                'id_fakultas' => (isset($row[1])) ? $row[1] : null
            ]);
            $jumlah++;
        }
        fclose($file);

       return back()->with('message', 'Berhasil menambahkan '.$jumlah.' jurusan');
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
