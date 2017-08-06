<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Proposal;

class ReviewerController extends Controller
{

    public function tambah(Request $request, $idproposal)
    {
        $proposal = Proposal::find($idproposal);

        $tahap = $request->tahap;

        // Daftar reviewer yang dikirim oleh user
        $daftarCalonReviewer = explode(',', $request->daftar_pengguna);

        // Daftar reviewer lama
        $daftarReviewerLama = $proposal->review()->where('tahap',$tahap)->pluck('id_pengguna')->toArray();

        // Daftar reviewer yang nantinya akan di hapus
        $daftarReviewerLengser = array_diff($daftarReviewerLama, $daftarCalonReviewer);

        // Daftar reviewer baru
        $daftarReviewerBaru = array_diff($daftarCalonReviewer, $daftarReviewerLama);

        // Menghapus reviewer dari proposal tertentu
        foreach ($daftarReviewerLengser as $index => $idpengguna) {
            $pengguna = User::find($idpengguna);
            $proposal->review()->where('tahap',$tahap)->detach($pengguna);
        }

        // Menambah reviewer ke proposal tertentu
        foreach ($daftarReviewerBaru as $index => $idpengguna) {
            $pengguna = User::find($idpengguna);
            $proposal->review()->attach($pengguna, [
                'tahap' => $tahap
            ]);
        }
    }

}
