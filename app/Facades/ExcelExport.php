<?php

namespace PMW\Facades;

use Illuminate\Support\Facades\Facade;

class ExcelExport extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'ExcelExport';
    }

}