<?php

/**
 * Ketika membuka halaman awal,
 * maka user akan diarahkan ke halaman dashboard
 */

Route::get('/',function(){
    return redirect()->route('dashboard');
});

Route::group(['middleware' => 'auth'], function(){

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

        Route::group(['prefix' => 'cari'], function(){
            
            Route::post('carimahasiswa',[
                'uses' => 'PencarianController@cariMahasiswa',
                'as' => 'cari.mahasiswa'
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

Route::group(['prefix' => 'unduh'],function (){

    Route::post('proposal',[
        'uses' => 'ProposalController@unduh',
        'as' => 'unduh.proposal',
    ]);

    Route::post('proposal/final',[
        'uses' => 'ProposalFinalController@unduh',
        'as' => 'unduh.proposal.final'
    ]);

    Route::post('laporan/kemajuan',[
        'uses' => 'LaporanController@unduh',
        'as' => 'unduh.laporan.kemajuan',
    ]);

    Route::post('laporan/akhir',[
        'uses' => 'LaporanAkhirController@unduh',
        'as' => 'unduh.laporan.akhir',
    ]);

});

/*
|---------------------------------------------
| Autentikasi bawaan dari Laravel
|---------------------------------------------
*/
Auth::routes();
