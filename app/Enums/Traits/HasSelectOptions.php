<?php

namespace App\Enums\Traits;

trait HasSelectOptions
{
    /**
     * Return array for select options.
     *
     * @return array|false
     */
    public static function toSelectOptions()
    {
        $arr = self::toArray();

        return array_combine($arr, $arr);
    }
}