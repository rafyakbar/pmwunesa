<?php

Route::group(['prefix' => 'terima'],function (){

    Route::post('undangan',[
        'uses' => 'UndanganDosenController@terimaUndangan',
        'as' => 'terima.undangan.dosen'
    ]);

});

Route::get('bimbingan',[
    'uses' => 'Page\DosenController@bimbingan',
    'as' => 'bimbingan'
]);

Route::post('request/reviewer',[
    'uses' => 'HakAksesController@requestHakAkses',
    'as' => 'request.reviewer'
]);
