<?php

Route::get('/',function(){
    return view('welcome');
})->middleware('guest');

Route::get('send',function(){
    Mail::to('rafy683@gmail.com')->send(new \PMW\Mail\RegisterMail());
    return 'Berhasil Mengirim';
});

Route::get('tes',function(){
    Excel::create('tes',function($excel){
        $excel->sheet('Sheet',function($sheet){
            $sheet->setOrientation('landscape');
            $sheet->setAutoSize(false);
            $sheet->appendRow([
                'Nama','NIM','Nama Tim'
            ]);
        });
    })->export('xls');
});

Route::get('/dashboard', function () {
    return view('home');
})->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'] ,function(){

    Route::group(['middleware' => 'ketuatim'],function(){
        
    });
    
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

Route::get('/loginz', function(){
    return view('auth');
})->name('loginz');

/*
|-----
| Autentikasi bawaan dari Laravel
|-----
*/
Auth::routes();
