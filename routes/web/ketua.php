<?php

/**
 * Route ini diperuntukkan bagi user dengan hak akses ketua tim
 */

Route::group(['prefix' => 'tambah'], function (){

    Route::put('proposal',[
        'uses' => 'ProposalController@tambah',
        'as' => 'unggah.proposal',
        'middleware' => 'ajax'
    ]);

    Route::put('logbook',[
        'uses' => 'LogBookController@tambah',
        'as' => 'tambah.logbook'
    ]);

});

Route::group(['prefix' => 'unggah' , 'middleware' => 'ajax'],function (){

    Route::put('proposalfinal',[
        'uses' => 'ProposalFinalController@unggah',
        'as' => 'unggah.proposal.final'
    ]);

    Route::put('laporankemajuan',[
        'uses' => 'LaporanKemajuanController@unggah',
        'as' => 'unggah.laporan.kemajuan'
    ]);

    Route::put('laporanakhir',[
        'uses' => 'LaporanAkhirController@unggah',
        'as' => 'unggah.laporan.akhir'
    ]);

});

Route::group(['prefix' => 'edit'], function (){

    Route::patch('proposal',[
        'uses' => 'ProposalController@edit',
        'as' => 'edit.proposal'
    ]);

    Route::patch('logbook',[
        'uses' => 'LogBookController@edit',
        'as' => 'edit.logbook'
    ]);

});

Route::post('undang/dosen',[
    'uses' => 'UndanganDosenController@kirimUndangan',
    'as' => 'undang.dosen',
    'middleware' => 'ajax'
]);