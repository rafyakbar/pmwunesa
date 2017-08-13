<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Proposal;
use PMW\User;

class ReviewerController extends Controller
{

    public function kelola(Request $request, $idproposal)
    {
        $proposal = Proposal::find($idproposal);

        $tahap = $request->tahap;

        // Daftar reviewer yang dikirim oleh user
        $daftarCalonReviewer = explode(',', $request->daftar_pengguna);

        // Daftar reviewer lama
        $daftarReviewerLama = $proposal->reviewer()->wherePivot('tahap',$tahap)->pluck('id_pengguna')->toArray();

        // Daftar reviewer yang nantinya akan di hapus
        $daftarReviewerLengser = array_diff($daftarReviewerLama, $daftarCalonReviewer);

        // Daftar reviewer baru
        $daftarReviewerBaru = array_diff($daftarCalonReviewer, $daftarReviewerLama);

        // Menghapus reviewer dari proposal tertentu
        foreach ($daftarReviewerLengser as $index => $idpengguna) {
            $pengguna = User::find($idpengguna);
            $proposal->reviewer()->wherePivot('tahap',$tahap)->detach($pengguna);
        }

        // Menambah reviewer ke proposal tertentu
        foreach ($daftarReviewerBaru as $index => $idpengguna) {
            $pengguna = User::find($idpengguna);
            $proposal->reviewer()->attach($pengguna, [
                'tahap' => $tahap
            ]);
        }
    }

}
