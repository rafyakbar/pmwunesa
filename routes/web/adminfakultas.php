<?php

Route::get('admin/fakultas/proposal/{lolos}/{perHalaman}', 'Page\AdminFakultasController@daftarProposal')->name('proposaladminfakultas');

Route::get('admin/fakultas/proposal/unduh/{lolos}', function (Request $request){
    return 'ddddd';
})->name('unduhproposalfakultas');