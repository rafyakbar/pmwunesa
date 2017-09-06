<?php

Route::group(['prefix' => 'terima'],function (){

    Route::post('undangan',[
        'uses' => 'UndanganDosenController@terimaUndangan',
        'as' => 'terima.undangan.dosen'
    ]);

});

Route::post('tolak/undangan', [
    'uses' => 'UndanganDosenController@tolak',
    'as' => 'tolak.undangan.dosen'
]);

Route::get('bimbingan',[
    'uses' => 'Page\DosenController@bimbingan',
    'as' => 'bimbingan'
]);

Route::get('logbook/{proposal}', [
    'uses' => 'Page\DosenController@logbook',
    'as' => 'logbook.bimbingan'
]);

Route::post('request/reviewer',[
    'uses' => 'HakAksesController@requestReviewer',
    'as' => 'request.reviewer'
]);
