<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Laporan;
use PMW\Support\FileHandler;

/**
 * Class untuk mengatur aktifitas dari Laporan Kemajuan
 *
 * Class LaporanController
 * @package PMW\Http\Controllers
 */
class LaporanController extends Controller
{

    private $validExtension = [
        'pdf', 'doc', 'docx'
    ];

    private $dir = 'laporan/kemajuan';

    private $validationArr = [
        'berkas' => 'required'
    ];

    use FileHandler;

    /**
     * Mengunggah laporan kemajuan
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
                    'jenis' => Laporan::KEMAJUAN,
                    'direktori' => $file,
                    'keterangan' => $request->keterangan
                ]);
            }
        }
    }

    /**
     * Mengunduh laporan kemajuan
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function unduh(Request $request)
    {
        $laporan = Auth::user()->laporan(Laporan::KEMAJUAN);

        return response()->download(storage_path('public/' . $this->dir . '/' . $laporan->direktori));
    }

    public function hapus(Request $request)
    {
        
    }

}
