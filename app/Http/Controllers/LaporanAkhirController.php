<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Support\FileHandler;
use PMW\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Proposal;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function unggah(Request $request)
    {
        $berkas = $request->file('berkas');

        if($this->bolehUnggah())
        {
            if($this->berkasValid($berkas))
            {
                $file = $this->unggahBerkas($berkas);

                Laporan::create([
                    'id_proposal' => Auth::user()->mahasiswa()->proposal()->id,
                    'jenis' => Laporan::AKHIR,
                    'direktori' => $file,
                    'keterangan' => $request->keterangan
                ]);

                return response()->json([
                    'message' => 'Berhasil mengunggah laporan kemajuan !',
                    'type' => 'success'
                ]);
            }

            return response()->json([
                'message' => 'Berkas tidak valid !',
                'type' => 'error'
            ]);
        }

        return response()->json([
            'message' => 'Gagal mengunggah laporan kemajuan !',
            'type' => 'error'
        ]);
    }

    /**
     * Mengunduh laporan akhir
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function unduh(Request $request)
    {
        if(!is_null($request->id_proposal))
            $laporan = Proposal::find($request->id_proposal)->laporanAkhir();

        if(Auth::user()->isMahasiswa())
            $laporan = Auth::user()->mahasiswa()->proposal()->laporanAkhir();

        return response()->download(storage_path('app/public/' . $this->dir . '/' . $laporan->direktori));
    }

    public function hapus(Request $request)
    {

    }

}
