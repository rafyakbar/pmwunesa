<?php

namespace PMW\Facades;

use Illuminate\Support\Facades\Facade;

class Carbon extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'Carbon';
    }

}
