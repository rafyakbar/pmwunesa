<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

Route::get('/', function () {
    return view('auth.login');
})->name('home');

/*
|-----
| Autentikasi bawaan dari Laravel
|-----
*/
Auth::routes();

Route::group(['prefix' => '' ,'middleware' => 'auth'],function(){
    Route::get('dashboard','DashboardController@index');
});
