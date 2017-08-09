<?php

Route::get('pengguna', 'Page\SuperAdminController@tampilDataPengguna');

Route::get('fakultas', 'Page\SuperAdminController@tampilDataFakultas');

Route::group(['prefix'=>'tambah'], function (){

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

});

Route::group(['prefix'=>'hapus'], function (){

});