<?php

namespace App\Helper;

class RandomHelper
{
    /**
     * Generate random string depending on given length
     *
     * @param integer $length
     * @return string
     */
    public function generateRandomString($length)
    {
        return bin2hex(random_bytes($length));
    }
}
