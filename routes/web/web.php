<?php

/**
 * Ketika membuka halaman awal,
 * maka user akan diarahkan ke halaman dashboard
 */

Route::get('/',function(){
    return redirect()->route('dashboard');
});

/**
 * Jika user mmebuka halaman dashboard, maka akan
 * dilakukan pengecekan apakah user sedang login atau belum.
 * Jika belum, maka akan diarahkan ke halaman login.
 */
Route::get('/dashboard', function () {
    return view('home');
})->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'] ,function(){
    
    Route::group(['middleware' => 'reviewer'],function(){

    });

    Route::group(['middleware' => 'adminfakultas'],function(){

    });

    Route::group(['middleware' => 'adminuniv'],function(){

    });

    Route::get('gantipassword',function(){
        return view('gantipass');
    });

    Route::post('gantipassword','SettingsController@gantiPassword')->name('gantipassword');

});

/*
|-----
| Autentikasi bawaan dari Laravel
|-----
*/
Auth::routes();
