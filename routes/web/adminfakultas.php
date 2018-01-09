<?php

Route::get('admin/fakultas/proposal/{lolos}/{perHalaman}', 'Page\AdminFakultasController@daftarProposal')->name('proposaladminfakultas');

Route::get('admin/fakultas/unduh/proposal/{lolos}', 'Page\AdminFakultasController@unduhProposal')->name('unduhproposalfakultas');