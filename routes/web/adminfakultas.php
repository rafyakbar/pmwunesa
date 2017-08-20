<?php

Route::get('admin/fakultas/proposal', 'Page\AdminFakultasController@daftarProposal')->name('proposaladminfakultas');

Route::get('admin/fakultas/proposal/unduh', 'Page\AdminFakultasController@unduhProposal')->name('unduhproposalfakultas');