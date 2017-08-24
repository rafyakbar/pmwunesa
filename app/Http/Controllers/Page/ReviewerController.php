<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PMW\Models\Aspek;
use PMW\Models\Laporan;
use PMW\Models\Penilaian;

class ReviewerController extends Controller
{

    public function daftarProposal($tahap = 1)
    {
        if ($tahap < 1 || $tahap > 2)
            return abort(404);

        $daftarProposal = Auth::user()->review()
            ->where('tahap', $tahap)
            ->paginate(1);

        if (!is_null(request()->get('sudahdinilai'))) {
            $daftarReviewPengguna = Auth::user()->review()->pluck('review.id');
            $reviewSudahDinilai = Penilaian::whereIn('id_review', $daftarReviewPengguna)
                ->distinct()
                ->pluck('id_review');

            $filtered = $reviewSudahDinilai;

            if (!request()->get('sudahdinilai')) {
                $filtered = Auth::user()->review()
                    ->whereNotIn('review.id', $reviewSudahDinilai)
                    ->pluck('review.id');
            }

            $daftarProposal = Auth::user()->review()
                ->where('tahap', $tahap)
                ->wherePivotIn('id', $filtered)
                ->paginate(1);
        }

        return view('dosen.reviewer.daftarproposal', [
            'daftarproposal' => $daftarProposal,
            'tahap' => $tahap
        ]);
    }

    public function daftarProposalFinal()
    {
        return view('dosen.reviewer.daftarproposalfinal', [
            'daftarproposal' => Auth::user()->review()->where('direktori_final', '!=', '')
        ]);
    }

    public function daftarLaporanKemajuan()
    {
        return view('dosen.reviewer.daftarlaporan', [
            'daftarlaporan' => Laporan::where('jenis', Laporan::KEMAJUAN)->whereIn('id_proposal', Auth::user()->review()->get()->pluck('id'))
        ]);
    }

    public function daftarLaporanAkhir()
    {
        return view('dosen.reviewer.daftarlaporan', [
            'daftarlaporan' => Laporan::where('jenis', Laporan::AKHIR)->whereIn('id_proposal', Auth::user()->review()->get()->pluck('id'))
        ]);
    }

    public function lihatNilaiReview($id)
    {
        // Mengambil proposal sesuai id dari review
        $proposal = Auth::user()->review()
            ->wherePivot('id', $id)
            ->first();

        if (is_null($proposal))
            return abort(404);

        // Mengambil nilai dari proposal sesuai dengan id reviewer
        $penilaian = $proposal->daftarReview($proposal->pivot->tahap)
            ->where('id_pengguna', Auth::user()->id)
            ->first()
            ->penilaian();

        return view('dosen.reviewer.nilaiproposal', [
            'penilaian' => $penilaian,
            'proposal' => $proposal
        ]);
    }

    public function tambahReview($id)
    {
        $proposal = Auth::user()->review()->wherePivot('id', $id)->first();

        if (is_null($proposal))
            return abort(404);

        return view('dosen.reviewer.kelolareview', [
            'proposal' => $proposal,
            'daftaraspek' => Aspek::all(),
            'type' => 'tambah'
        ]);
    }

    public function editNilaiReview($id)
    {
        $proposal = Auth::user()->review()->wherePivot('id', $id)->first();

        if (is_null($proposal))
            return abort('404');

        $penilaian = $proposal->penilaian($id);

        return view('dosen.reviewer.kelolareview', [
            'penilaian' => $penilaian,
            'daftaraspek' => Aspek::all(),
            'proposal' => $proposal,
            'type' => 'edit'
        ]);
    }

}
