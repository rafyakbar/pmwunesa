<?php

namespace PMW\Support;

class Dana
{

    public function format($currency)
    {
        return number_format($currency, 0, ',', '.');
    }

}