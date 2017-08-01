<?php

/**
 * Route ini diperuntukkan bagi user dengan hak akses ketua tim
 */

Route::get('logbook',[
    'uses' => 'LogBookController@ketuaPage',
    'as' => 'logbook'
]);

Route::get('proposal',[
    'uses' => 'ProposalController@ketuaPage',
    'as' => 'proposal'
]);

Route::get('finalreport',[
    'uses' => 'FinalReportController@ketuaPage',
    'as' => 'finalreport'
]);