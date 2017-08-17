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

Route::get('laporan', function(){
    return view('mahasiswa.laporan');
})->name('laporan');

// Route::group(['prefix' => 'laporan'], function () {
//
//     Route::get('kemajuan', function () {
//         return view('mahasiswa.laporankemajuan');
//     })->name('laporan.kemajuan');
//
//     Route::get('akhir', function () {
//         return view('mahasiswa.laporanakhir');
//     })->name('laporan.akhir');
//
// });

Route::group(['prefix' => 'undang'], function () {

    Route::get('anggota', function () {
        return view('mahasiswa.undanganggota');
    });

    Route::post('anggota', [
        'uses' => 'UndanganTimController@buatUndangan',
        'as' => 'undang.anggota',
    ]);

    Route::post('terima', [
        'uses' => 'UndanganTimController@terimaUndangan',
        'as' => 'terima.undangan.tim'
    ]);

    Route::post('tolak', [
        'uses' => 'UndanganTimController@tolakUndangan',
        'as' => 'tolak.undangan.tim'
    ]);

    Route::post('kirimulang', [
        'uses' => 'UndanganTimController@kirimUlang',
        'as' => 'kirimulang.undangan.tim'
    ]);

});

Route::group(['prefix' => 'hapus'],function(){

    Route::post('undangan',[
        'uses' => 'UndanganTimController@hapusUndangan',
        'as' => 'hapus.undangan.tim'
    ]);

});
