<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Support\FileHandler;
use PMW\Models\Laporan;

class LaporanAkhirController extends Controller
{

    private $validExtension = [
        'pdf', 'doc', 'docx'
    ];

    private $dir = 'laporan/akhir';

    private $validationArr = [
        'berkas' => 'required'
    ];

    use FileHandler;

    /**
     * Mengunggah laporan akhir
     *
     * @param Request $request
     */
    public function unggah(Request $request)
    {
        $berkas = $request->file('berkas');

        if($this->bolehUnggah())
        {
            if($this->berkasValid($berkas))
            {
                $file = $this->unggahBerkas($berkas);

                Auth::user()->laporan()->create([
                    'id_proposal' => Auth::user()->proposal()->id,
                    'jenis' => Laporan::AKHIR,
                    'direktori' => $file,
                    'keterangan' => $request->keterangan
                ]);
            }
        }
    }

    /**
     * Mengunduh laporan akhir
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function unduh(Request $request)
    {
        $laporan = Auth::user()->laporan(Laporan::AKHIR);

        return response()->download(storage_path('public/' . $this->dir . '/' . $laporan->direktori));
    }

    public function hapus(Request $request)
    {

    }

}
