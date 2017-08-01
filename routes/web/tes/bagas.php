<?php

/**
 * Route buat testing
 */

Route::get('tes',function(){
    Excel::create('tes',function($excel){
        $excel->sheet('Sheet',function($sheet){
            $sheet->setOrientation('landscape');
            $sheet->setAutoSize(false);
            $sheet->appendRow([
                'Nama','NIM','Nama Tim'
            ]);
        });
    })->export('xls');
});

Route::get('user',function(){
    dd(\PMW\User::all());
});

Route::get('bla',function(){
//    foreach (\PMW\Models\Proposal::find(20)->pengguna()->cursor() as $pengguna)
//    {
//        echo $pengguna->nama . '<br/>';
//    }
return \PMW\User::find('5817875802')->proposal()->first()->pivot;
});