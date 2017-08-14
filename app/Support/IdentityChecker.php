<?php

namespace PMW\Support;

class IdentityChecker
{

    public function mungkinNIM($id)
    {
        return (count($id) == 11);
    }

    public function mungkinNIP($id)
    {
        return (count($id) == 20);
    }

}
