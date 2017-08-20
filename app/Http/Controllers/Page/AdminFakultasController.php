<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PMW\Facades\Dana;
use PMW\Http\Controllers\Controller;
use PMW\Models\Fakultas;
use PMW\Models\Prodi;
use PMW\Models\Proposal;
use PMW\User;
use Maatwebsite\Excel\Facades\Excel;

class AdminFakultasController extends Controller
{
    public function daftarProposal()
    {
        return view('admin.fakultas.daftarproposal', [
            'proposal' => Proposal::proposalPerFakultas(Auth::user()->prodi()->jurusan()->id_fakultas)
        ]);
    }

    public function unduhProposal()
    {
        $fakultas = Fakultas::find(Auth::user()->prodi()->jurusan()->id_fakultas);
        return Excel::create('Proposal Fakultas ' . $fakultas->nama, function ($excel) {
            $excel->sheet('Sheet', function ($sheet) {
                $fakultas = Fakultas::find(Auth::user()->prodi()->jurusan()->id_fakultas);
                $proposal = Proposal::proposalPerFakultas($fakultas->id);
                $sheet->setOrientation('landscape');
                $sheet->setAutoSize(true);
                $sheet->mergeCells('A1:B1');
                $sheet->appendRow([
                    'Proposal Fakultas '. $fakultas->nama
                ]);
                $sheet->appendRow(['']);
                $sheet->appendRow([
                    'No', 'Ketua Tim', 'Judul', 'Jenis Usaha', 'Usulan Dana', 'Reviewer Tahap 1', 'Reviewer Tahap 2'
                ]);
                $counter = 0;
                foreach ($proposal as $item) {
                    $reviewerTahap1 = '';
                    $reviewerTahap2 = '';
                    foreach (Proposal::find($item->id_proposal)->reviewer()->wherePivot('tahap', 1)->get() as $value) {
                        $reviewerTahap1=$reviewerTahap1.$value->nama.'|';
                    }
                    foreach (Proposal::find($item->id_proposal)->reviewer()->wherePivot('tahap', 2)->get() as $value) {
                        $reviewerTahap2=$reviewerTahap2.$value->nama.'|';
                    }
                    $sheet->appendRow([
                        ++$counter,
                        $item->id_ketua . ' ' . $item->nama_ketua,
                        $item->judul,
                        $item->jenis_usaha,
                        Dana::format($item->usulan_dana),
                        rtrim($reviewerTahap1,'|'),
                        rtrim($reviewerTahap2,'|')
                    ]);
                }
            });
        })->export('xls');
    }
}
