<?php

Route::group(['prefix' => 'tambah'],function (){

    Route::get('review/{idproposal}/{tahap}',[
        'uses' => 'Page\DosenController@tambahReview',
        'as' => 'tambah.review'
    ]);

    Route::put('review/{idproposal}/{tahap}',[
        'uses' => 'ReviewController@tambah',
        'as' => 'tambah.review'
    ]);

});