<?php

Route::get('proposal',function(){
    return view('mahasiswa.proposal');
})->name('proposal');

Route::get('logbook',function(){
    return view('mahasiswa.logbook');
})->name('logbook');

Route::get('proposal/final',function(){
    return view('mahasiswa.proposalfinal');
})->name('proposal.final');

Route::group(['prefix' => 'laporan'],function (){

    Route::get('kemajuan',function(){
        return view('mahasiswa.laporan.kemajuan');
    })->name('laporan.kemajuan');

    Route::get('akhir',function(){
        return view('mahasiswa.laporan.akhir');
    })->name('laporan.akhir');

});

Route::group(['prefix' => 'undang'],function(){

    Route::get('anggota', function(){
        return view('mahasiswa.undanganggota');
    })->middleware('mahasiswa');

    Route::post('anggota', [
        'uses' => 'UndanganTimController@buatUndangan',
        'as' => 'undang.anggota',
        'middleware' => 'mahasiswa'
    ]);

    Route::post('terima',[
        'uses' => 'UndanganTimController@terimaUndangan',
        'as' => 'terima.undangan.tim',
        'middleware' => 'mahasiswa'
    ]);

});