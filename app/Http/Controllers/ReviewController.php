<?php

namespace PMW\Http\Controllers;

use Illuminate\Http\Request;
use PMW\Models\Aspek;
use PMW\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Review;

class ReviewController extends Controller
{

    public function tambah(Request $request, $idproposal, $tahap)
    {
        $proposal = Proposal::find($idproposal);
        $reviewer = Auth::user();
        $review = $reviewer->review()
            ->where('id_proposal', $proposal->id)
            ->where('tahap', $tahap)
            ->first();
        $review = Review::find($review->pivot->id);

        $daftarAspek = Aspek::all();

        if (count($daftarAspek) === count($request->input('nilai.*'))) {
            // Menambahkan nilai per aspek
            foreach ($daftarAspek as $aspek) {
                if ($request->has('nilai.' . $aspek->id)) {
                    $review->penilaian()->attach(Aspek::find($aspek->id), [
                        'nilai' => $request->input('nilai.' . $aspek->id)
                    ]);
                }
            }

            // Menambah komentar
            $review->update([
                'komentar' => $request->komentar
            ]);
        }
    }

    public function edit(Request $request, $idproposal, $tahap)
    {
        $proposal = Proposal::find($idproposal);
        $reviewer = Auth::user();
        $review = $reviewer->review()
            ->where('id_proposal', $proposal->id)
            ->where('tahap', $tahap)
            ->first();
        $review = Review::find($review->pivot->id);

        $daftarAspek = Aspek::all();

        if (count($daftarAspek) === count($request->input('nilai.*'))) {
            // Menambahkan nilai per aspek
            foreach ($daftarAspek as $aspek) {
                if ($request->has('nilai.' . $aspek->id)) {
                    $review->ubahNilai(Aspek::find($aspek->id),$request->input('nilai.' . $aspek->id));
                }
            }

            // Menambah komentar
            $review->update([
                'komentar' => $request->komentar
            ]);
        }
    }

}
