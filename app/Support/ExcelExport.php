<?php

namespace PMW\Support;

use Maatwebsite\Excel\Facades\Excel;
use PMW\User;

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