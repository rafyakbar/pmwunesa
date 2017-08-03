<?php

/**
 * Ketika membuka halaman awal,
 * maka user akan diarahkan ke halaman dashboard
 */

Route::get('/',function(){
    return redirect()->route('dashboard');
});

Route::group(['middleware' => 'auth'] ,function(){

    Route::group(['middleware' => 'profil'], function(){

        /**
         * Jika user mmebuka halaman dashboard, maka akan
         * dilakukan pengecekan apakah user sedang login atau belum.
         * Jika belum, maka akan diarahkan ke halaman login.
         */
        Route::get('dashboard', [
            'uses' => 'DashboardController@index',
            'as' => 'dashboard'
        ]);

        Route::group(['prefix' => 'cari'],function(){
            Route::post('carimahasiswa',[
                'uses' => 'PencarianController@cariMahasiswa',
                'as' => 'cari.mahasiswa'
            ]);

        });

        Route::group(['prefix' => 'undang'],function(){

            Route::get('anggota', function(){
                return view('mahasiswa.undanganggota');
            })->middleware('mahasiswa');

            Route::post('anggota', [
                'uses' => 'UndanganTimController@buatUndangan',
                'as' => 'undang.anggota',
                'middleware' => 'mahasiswa'
            ]);

            Route::post('terima',[
                'uses' => 'UndanganTimController@terimaUndangan',
                'as' => 'terima.undangan.tim',
                'middleware' => 'mahasiswa'
            ]);

        });

    });

    Route::get('pengaturan', function(){
         return view('pengaturan');
    })->name('pengaturan');

    Route::group(['prefix' => 'ubah'], function(){

        Route::get('password',function(){
            return view('ubahpassword');
        })->name('ubah.password');

        Route::post('profil',[
            'uses' => 'UserController@editProfil',
            'as' => 'ubah.profil'
        ]);
        
    });

});

/*
|-----
| Autentikasi bawaan dari Laravel
|-----
*/
Auth::routes();
