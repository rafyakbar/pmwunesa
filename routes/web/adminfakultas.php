<?php

Route::get('admin/fakultas/proposal/{filter}', 'Page\AdminFakultasController@daftarProposal')->name('proposaladminfakultas');

Route::get('admin/fakultas/proposal/unduh/{filter}', 'Page\AdminFakultasController@unduhProposal')->name('unduhproposalfakultas');