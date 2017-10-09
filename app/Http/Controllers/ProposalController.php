<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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

    private $dir = 'proposal/awal';

    private $validationArr = [
        'usulan_dana'   => 'required|numeric',
        'judul'         => 'required',
        'abstrak'       => 'required',
        'jenis_usaha'   => 'required',
        'keyword'       => 'required',
        'berkas'        => 'required|file'
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
    public function unggah(Request $request)
    {
        if($this->bolehUnggah()) {
            // Validasi
            $this->validate($request, $this->validationArr);

            // Mengunggah proposal ke storage
            if ($this->berkasValid($request->file('berkas'))) {

                $this->hapusProposalSebelumnya();

                // Mengunggah
                $file = $this->unggahBerkas($request->file('berkas'));

                Auth::user()->mahasiswa()->proposal()->update([
                    'usulan_dana'   => $request->usulan_dana,
                    'judul'         => $request->judul,
                    'abstrak'       => $request->abstrak,
                    'jenis_usaha'   => $request->jenis_usaha,
                    'keyword'       => $request->keyword,
                    'direktori'     => $file
                ]);

                return response()->json([
                    'message' => 'Berhasil mengunggah proposal !',
                    'error' => 0
                ]);
            } else {
                return response()->json([
                    'message' => 'Ekstensi file tidak valid !',
                    'error' => 1
                ]);
            }
        }
        else {
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

        if(Auth::user()->isMahasiswa())
            $proposal = Auth::user()->mahasiswa()->proposal();

        // proses unduh
        return response()->download(
            storage_path('app/public/' . $this->dir . '/' . $proposal->direktori)
        );
    }

    public function loloskan(Request $request)
    {
        $proposal = Proposal::find($request->id_proposal);

        $proposal->update([
            'lolos' => true
        ]);
    }

    /**
     * Menampikkan detail proposal yang akan ditampilkan pada tabel
     * ketika sebuah baris(<tr></tr>) proposal di klik
     *
     * @param Request $request
     * @return void
     */
    public function dataAjax(Request $request)
    {
        $proposal = Proposal::find($request->id);

        return view('ajax.dataproposal',[
            'proposal' => $proposal
        ]);
    }

    /**
     * Menghapus file proposal sebelumnya
     * digunakan jika ketua tim ingin mengganti proposal
     *
     * @return void
     */
    private function hapusProposalSebelumnya()
    {
        $proposal = Auth::user()->mahasiswa()->proposal();

        // Jika pernah mengunggah proposal
        if(!is_null($proposal->direktori)) {
            Storage::delete('public/' . $this->dir . '/' . $proposal->direktori);
        }
    }

}
