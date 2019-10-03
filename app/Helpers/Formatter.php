<?php

namespace App\Helpers;

class Formatter
{
    /**
     * @param $value
     *
     * @return string
     */
    public static function money($value)
    {
        return number_format($value, 2, '.', ',');
    }
}