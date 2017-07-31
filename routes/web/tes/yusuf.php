<?php

/*
 * Route testing buat yusuf
 */

Route::get('/loginz', function(){
    return view('auth');
})->name('loginz');