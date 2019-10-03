<?php

namespace App\Enums;

use App\Enums\Traits\HasSelectOptions;
use MyCLabs\Enum\Enum;

class FeeType extends Enum
{
    use HasSelectOptions;

    private const PERCENT = 'percent';
    private const FIXED   = 'fixed';

    /**
     * @return \App\Enums\FeeType
     */
    public static function fixed()
    {
        return new FeeType(self::FIXED);
    }

    /**
     * @return \App\Enums\FeeType
     */
    public static function percent()
    {
        return new FeeType(self::PERCENT);
    }
}