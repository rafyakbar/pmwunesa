<?php

namespace PMW\Support;

use Maatwebsite\Excel\Facades\Excel;
use PMW\Models\Fakultas;
use PMW\User;
use PMW\Models\Proposal;
use PMW\Facades\Dana;

class ExcelExport
{

    protected $name;

    protected $totalSheet;

    public function daftarUser()
    {
        Excel::create('tes',function($excel){
                $excel->sheet('Sheet',function($sheet){
                    $sheet->setOrientation('landscape');
                    // $sheet->setAutoSize(false);
                    $sheet->appendRow([
                        'Nama','NIM'
                    ]);
                    foreach(User::all() as $user)
                    {
                        $sheet->appendRow([
                            $user->nama,$user->id
                        ]);
                    }
                });
            })->export('xls');
    }

    public function unduhProposal($fakultas = null, $tahap = 'semua')
    {
        $GLOBALS['tahap'] = $tahap;
        $GLOBALS['fakultas'] = $fakultas;
        $nama_file = (is_null($fakultas)) ? 'Proposal Semua Fakultas' : 'Proposal Fakultas ' . Fakultas::find($fakultas)->nama;
        return Excel::create($nama_file, function ($excel) {
            $excel->sheet('Sheet', function ($sheet) {
                $proposal = (is_null($GLOBALS['fakultas'])) ? Proposal::all() : Proposal::proposalPerFakultas($GLOBALS['fakultas']);
                $sheet->setOrientation('landscape');
                $sheet->setAutoSize(true);
                $sheet->mergeCells('A1:B1');
                $sheet->appendRow([
                    (is_null($GLOBALS['fakultas'])) ? 'Proposal Semua Fakultas' : 'Proposal Fakultas ' . Fakultas::find($GLOBALS['fakultas'])->nama
                ]);
                $sheet->appendRow(['']);
                $sheet->appendRow([
                    'No', 'Ketua Tim', 'Judul', 'Jenis Usaha', 'Usulan Dana', 'Reviewer Tahap 1', 'Reviewer Tahap 2'
                ]);
                $counter = 0;
                $reviewerTahap1 = '';
                $reviewerTahap2 = '';
                foreach ($proposal as $item) {
                    if ($GLOBALS['tahap'] != 'semua') {
                        if (Proposal::find($item->id)->lolos(explode('_', $GLOBALS['tahap'])[1])) {
                            $ketua = Proposal::find($item->id)->ketua();
                            foreach (Proposal::find($item->id)->reviewer()->wherePivot('tahap', 1)->get() as $value) {
                                $reviewerTahap1 = $reviewerTahap1 . $value->nama . ', ';
                            }
                            foreach (Proposal::find($item->id)->reviewer()->wherePivot('tahap', 2)->get() as $value) {
                                $reviewerTahap2 = $reviewerTahap2 . $value->nama . ', ';
                            }
                            $sheet->appendRow([
                                ++$counter,
                                $ketua->id . ' ' . $ketua->nama,
                                $item->judul,
                                $item->jenis_usaha,
                                Dana::format($item->usulan_dana),
                                rtrim($reviewerTahap1, ','),
                                rtrim($reviewerTahap2, ',')
                            ]);
                        }
                    } else {
                        foreach (Proposal::find($item->id)->reviewer()->wherePivot('tahap', 1)->get() as $value) {
                            $reviewerTahap1 = $reviewerTahap1 . $value->nama . ', ';
                        }
                        foreach (Proposal::find($item->id)->reviewer()->wherePivot('tahap', 2)->get() as $value) {
                            $reviewerTahap2 = $reviewerTahap2 . $value->nama . ', ';
                        }
                        $ketua = Proposal::find($item->id)->ketua();
                        $sheet->appendRow([
                            ++$counter,
                            $ketua->id . ' ' . $ketua->nama,
                            $item->judul,
                            $item->jenis_usaha,
                            Dana::format($item->usulan_dana),
                            rtrim($reviewerTahap1, ', '),
                            rtrim($reviewerTahap2, ', ')
                        ]);
                    }
                }
            });
        })->export('xls');
    }

    public function name($name)
    {
        $this->name = $name;
    }

    public function sheet($sheet)
    {
        $this->totalSheet = $sheet;
    }

    public function export()
    {
        Excel::create('tes',function($excel){
                $excel->sheet('Sheet',function($sheet){
                    $sheet->setOrientation('landscape');
                    $sheet->setAutoSize(false);
                    $sheet->appendRow([
                        'Nama','NIM','Nama Tim'
                    ]);
                });
            })->export('xls');
    }

}