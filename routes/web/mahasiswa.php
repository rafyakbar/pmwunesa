<?php

Route::get('proposal',[
    'uses' => 'Page\PageController@proposalDetail',
    'as' => 'proposal'
]);

Route::get('logbook', function () {
    return view('mahasiswa.daftarlogbook');
})->name('logbook');

Route::get('proposal/final', function () {
    return view('mahasiswa.proposalfinal');
})->name('proposal.final');

Route::group(['prefix' => 'laporan'], function () {

    Route::get('kemajuan', function () {
        return view('mahasiswa.laporankemajuan');
    })->name('laporan.kemajuan');

    Route::get('akhir', function () {
        return view('mahasiswa.laporanakhir');
    })->name('laporan.akhir');

});

Route::group(['prefix' => 'undang'], function () {

    Route::get('anggota', function () {
        return view('mahasiswa.undanganggota');
    })->middleware('mahasiswa');

    Route::post('anggota', [
        'uses' => 'UndanganTimController@buatUndangan',
        'as' => 'undang.anggota',
        'middleware' => 'mahasiswa'
    ]);

    Route::post('terima', [
        'uses' => 'UndanganTimController@terimaUndangan',
        'as' => 'terima.undangan.tim',
        'middleware' => 'mahasiswa'
    ]);

});

Route::group(['prefix' => 'hapus'],function(){

    Route::get('undangan/{id}',[
        'uses' => 'UndanganTimController@hapusUndangan',
        'as' => 'hapus.undangan.tim'
    ]);

});
