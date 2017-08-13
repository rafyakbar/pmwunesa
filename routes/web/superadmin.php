<?php

Route::get('pengguna', 'Page\SuperAdminController@tampilDataPengguna')->name('pengguna');

Route::get('fakultas', 'Page\SuperAdminController@tampilDataFakultas')->name('fakultas');

Route::get('aspek', 'Page\SuperAdminController@tampilDataAspek')->name('aspek');

Route::get('proposal', 'Page\SuperAdminController@tampilDataProposal')->name('proposal');

Route::put('editreviewer', 'Page\SuperAdminController@editReviewer')->name('editreviewer');

Route::group(['prefix' => 'permintaan'], function (){

    Route::get('hakakses', [
        'uses'  => 'Page\SuperAdminController@tampilRequestHakAkses',
        'as'    => 'permintaan.hakakses'
    ]);

});

Route::group(['prefix' => 'tambah'], function (){

   Route::put('fakultas',[
       'uses'   => 'FakultasController@tambah',
       'as'     => 'tambah.fakultas'
   ]);

   Route::put('jurusan',[
       'uses'   => 'JurusanController@tambah',
       'as'     => 'tambah.jurusan'
   ]);

   Route::put('prodi',[
       'uses'   => 'ProdiController@tambah',
       'as'     => 'tambah.prodi'
   ]);

   Route::put('pengguna',[
       'uses'   => 'UserController@tambah',
       'as'     => 'tambah.user'
   ]);

    Route::put('aspek',[
        'uses'  => 'AspekController@tambah',
        'as'    => 'tambah.aspek'
    ]);

});

Route::group(['prefix' => 'hapus'], function (){
    Route::put('fakultas',[
        'uses'  => 'FakultasController@hapus',
        'as'    => 'hapus.fakultas'
    ]);

    Route::put('jurusan',[
        'uses'  => 'JurusanController@hapus',
        'as'    => 'hapus.jurusan'
    ]);

    Route::put('prodi',[
        'uses' => 'ProdiController@hapus',
        'as'   => 'hapus.prodi'
    ]);

    Route::put('pengguna',[
        'uses' => 'UserController@hapus',
        'as'   => 'hapus.pengguna'
    ]);

    Route::put('aspek',[
        'uses'  => 'AspekController@hapus',
        'as'    => 'hapus.aspek'
    ]);
});

Route::group(['prefix' => 'edit'], function (){

    Route::put('fakultas',[
        'uses'  => 'FakultasController@edit',
        'as'    => 'edit.fakultas'
    ]);

    Route::put('jurusan',[
        'uses'  => 'JurusanController@edit',
        'as'    => 'edit.jurusan'
    ]);

    Route::put('prodi',[
        'uses'  => 'ProdiController@edit',
        'as'    => 'edit.prodi'
    ]);

    Route::put('aspek',[
        'uses'  => 'AspekController@edit',
        'as'    => 'edit.aspek'
    ]);

    Route::put('terimahakakses',[
        'uses'  => 'HakAksesController@terimaRequest',
        'as'    => 'set.terimahakakses'
    ]);

    Route::put('tolakhakakses',[
        'uses'  => 'HakAksesController@tolakRequest',
        'as'    => 'set.tolakhakakses'
    ]);

});