<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Proposal;
use PMW\Support\FileHandler;

class ProposalController extends Controller
{

    /**
     * Format atau ekstensi file yang diperbolehkan untu diunggah
     *
     * @var array
     */
    private $validExtension = [
        'pdf', 'doc', 'docx'
    ];

    private $dir = 'proposal';

    private $validationArr = [
        'usulan_dana'   => 'required|numeric',
        'judul'         => 'required',
        'abstrak'       => 'required',
        'jenis_usaha'   => 'required',
        'keyword'       => 'required',
        'berkas'        => 'required'
    ];

    use FileHandler;

    /**
     * Menambah proposal, walaupun sebenarnya bukan menambah, hal ini karena proposal
     * telah dibuat sebelumnya, namun semua isi dalam tabel masih kosong
     *
     * Proposal dibuat secara otomatis ketika ada user yang menerima undangan dari user lain.
     * Secara otomatis, user pengirim undangan akan dijadikan sebagai ketua dan membuat proposal
     * baru ke dalam tabel
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tambah(Request $request)
    {
        if($this->bolehUnggah()) {
            // Validasi
            $this->validate($request, $this->validationArr);

            // Mengunggah proposal ke storage
            if ($this->berkasValid($request->file('berkas'))) {
                // Mengunggah
                $file = $this->unggahBerkas($request->file('berkas'));

                Auth::user()->proposal()->update([
                    'usulan_dana'   => $request->usulan_dana,
                    'judul'         => $request->judul,
                    'abstrak'       => $request->abstrak,
                    'jenis_usaha'   => $request->jenis_usaha,
                    'keyword'       => $request->keyword,
                    'direktori'     => $file
                ]);

                return response()->json([
                    'message' => 'Berhasil membuat proposal !',
                    'error' => 0
                ]);
            } else {
                return response()->json([
                    'message' => 'Ekstensi file tidak valid !',
                    'error' => 1
                ]);
            }
        }
        else{
            return response()->json([
                'message' => 'Anda tidak bisa mengunggah berkas !',
                'error' => 2
            ]);
        }
    }



    public function edit(Request $request)
    {
        $this->validate($request,$this->validationArr);

        $proposal = Auth::user()->mahasiswa()->proposal();

        $proposal->update([
            'usulan_dana'   => $request->usulan_dana,
            'judul'         => $request->judul,
            'abstrak'       => $request->abstrak,
            'jenis_usaha'   => $request->jenis_usaha,
            'keyword'       => $request->keyword,
            'direktori'     => $request->direktori
        ]);
    }

    /**
     * Mengunduh proposal
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function unduh(Request $request)
    {
        $proposal = Proposal::find($request->id);

        // proses unduh
        return response()->download(storage_path('app/public/proposal/' . $proposal->direktori));
    }

}
