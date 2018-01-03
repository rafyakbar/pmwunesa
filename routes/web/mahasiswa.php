<?php

Route::namespace('Page')->group(function() {
    Route::get('proposal', [
        'uses' => 'PageController@proposalDetail',
        'as' => 'proposal'
    ]);
    Route::get('logbook', [
        'uses' => 'MahasiswaController@logbook',
        'as' => 'logbook'
    ]);
});

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
//

Route::get('infotim', [
    'uses' => 'Page\MahasiswaController@infoTim',
    'as' => 'info.tim'
]);

Route::group(['prefix' => 'undang'], function () {

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
