<?php

namespace App\Enums;

use App\Enums\Traits\HasSelectOptions;
use MyCLabs\Enum\Enum;

class PromotionType extends Enum
{
    use HasSelectOptions;

    private const SERVICE_FEE_WAIVER = 'service fees waiver';

    /**
     * @return \App\Enums\PromotionType
     */
    public static function serviceFeeWaiver()
    {
        return new PromotionType(self::SERVICE_FEE_WAIVER);
    }
}