<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\User;
use PMW\Models\Proposal;

class UndanganTimController extends Controller
{

    /**
     * Membuat undangan untuk mahasiswa lain agar bisa
     * bergabung dalam tim
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buatUndangan(Request $request)
    {
        $dari = Auth::user()->id;
        $untuk = $request->untuk;
        
        if(User::findOrFail($untuk) && $dari != $untuk)
        {
            if(!Auth::user()->mahasiswa()->punyaTim())
            {
                Auth::user()->mahasiswa()->undanganTimKetua()->attach(User::find($untuk)->mahasiswa());
                return response()->json([
                    'message' => 'Berhasil mengirim undangan !',
                    'error' => 0
                ]);
            }
            else
            {
                return response()->json([
                    'message' => 'Anda tidak bisa mengirim undangan !',
                    'error' => 1
                ]);
            }
        }
        return response()->json([
            'message' => 'Gagal mengirim undangan !',
            'error' => 2
        ]);
    }

    /**
     * Menerima undangan untuk bergabung dalam tim
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function terimaUndangan(Request $request)
    {
        $dari = User::find($request->dari);
        $untuk = Auth::user();

        // Memastikan bahwa user tidak sedang mengirim undangan dan
        // pengirim undangan bukan merupakan anggota, serta user
        // belum memiliki tim, serta tidak bisa menerima undangan jika anggota tim sudah
        // berjumlah 3 orang
        if($untuk->mahasiswa()->undanganTimKetua()->count() == 0 &&
            !$untuk->mahasiswa()->punyaTim())
        {
            if(!$dari->mahasiswa()->timLengkap()) {

                // Terima undangan
                if ($dari->mahasiswa()->punyaProposal()) {
                    $proposal = $dari->mahasiswa()->proposal();
                } else {
                    $proposal = Proposal::create([
                        'lolos' => false
                    ]);
                }

                // Mengupdate proposal dari pengirim undangan
                $dari->mahasiswa()->update([
                    'id_proposal' => $proposal->id
                ]);

                if ($dari->hasRole(User::ANGGOTA))
                    $dari->jadikanKetua();

                // Menambahkan id proposal pada user
                $untuk->mahasiswa()->update([
                    'id_proposal' => $proposal->id
                ]);

                $dari->mahasiswa()->undanganTimKetua()->detach($untuk->mahasiswa());

                return response()->json([
                    'message' => 'Anda berhasil bergabung dalam tim ' . $dari->nama,
                    'error' => 0
                ]);
            }
            else{
                return response()->json([
                    'message' => 'Pengirim undangan telah memiliki jumlah anggota yang mencukupi !',
                    'error' => 2
                ]);
            }
        }
        else
        {
            return response()->json([
                'message' => 'Anda tidak bisa menerima undangan ini !',
                'error' => 1
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tolakUndangan(Request $request)
    {
        $dari = User::find($request->dari);
        $untuk = Auth::user();

        $untuk->mahasiswa()->tolakUndanganTim($dari);

        return response()->json([
            'message' => 'Undangan telah ditolak !',
            'error' => 0
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hapusUndangan(Request $request)
    {
        $untuk = $request->id_pengguna;

        Auth::user()->mahasiswa()->undanganTimKetua()->detach(User::find($untuk)->mahasiswa());

        return back();
    }

}
