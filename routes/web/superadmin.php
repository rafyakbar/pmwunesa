<?php

Route::get('pengguna', 'Page\SuperAdminController@tampilDataPengguna');

Route::get('fakultas', 'Page\SuperAdminController@tampilDataFakultas');

Route::group(['prefix'=>'tambah'], function (){
   Route::put('fakultas',[
       'uses' => 'FakultasController@tambah',
       'as' => 'tambah.fakultas'
   ]);
});

Route::group(['prefix'=>'hapus'], function (){

});