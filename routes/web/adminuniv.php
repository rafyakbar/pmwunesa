<?php

Route::get('admin/universitas/proposal/{fakultas}/{lolos}/{perHalaman}', 'Page\AdminUniversitasController@daftarProposal')->name('proposaladminuniv');

Route::get('admin/universitas/unduh/proposal/{fakultas}/{lolos}', 'Page\AdminUniversitasController@unduhProposal')->name('unduhproposaluniv');