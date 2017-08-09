<?php
/**
 * Created by PhpStorm.
 * User: Public
 * Date: 8/9/2017
 * Time: 3:46 PM
 */

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