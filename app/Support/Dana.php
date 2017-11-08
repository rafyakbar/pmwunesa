<?php

namespace PMW\Support;

use NumberFormatter;

class Dana
{

    private $local = 'id-ID';

    private $formatter;

    public function __construct()
    {
        $this->formatter = new NumberFormatter($this->local, 2);
    }

    public function format($currency, $type = NULL)
    {
        return $this->formatter->format($currency);
    }

}