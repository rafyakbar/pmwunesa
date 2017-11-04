<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Pengaturan;

class PengaturanController extends Controller
{
    public function edit(Request $request)
    {
        $pengaturan = Pengaturan::find($request->id);
        if ($pengaturan->nama == 'Nilai minimum proposal'){
            $this->validate($request, [
                'keterangan' => 'required|integer|between:0,100'
            ]);
        }
        else{
            $this->validate($request, [
                'keterangan' => 'required|max:19'
            ]);
        }

        $pengaturan->update([
            'keterangan' => $request->keterangan
        ]);

        return back()->with('message', 'Pengaturan berhasil disimpan!');
    }
}
