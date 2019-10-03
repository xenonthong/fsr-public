<?php

namespace App\Enums;

use App\Enums\Traits\HasSelectOptions;
use MyCLabs\Enum\Enum;

class PaymentMode extends Enum
{
    use HasSelectOptions;

    private const BANK_TRANSFER = 'bank transfer';
    private const JP_CARD   = 'japan card';
    private const JP_BANK   = 'japan bank';
    private const WALK_IN   = 'walk in';

    /**
     * @return \App\Enums\PaymentMode
     */
    public static function bankTransfer()
    {
        return new PaymentMode(self::BANK_TRANSFER);
    }

    /**
     * @return \App\Enums\PaymentMode
     */
    public static function jpCard()
    {
        return new PaymentMode(self::JP_CARD);
    }

    /**
     * @return \App\Enums\PaymentMode
     */
    public static function jpBank()
    {
        return new PaymentMode(self::JP_BANK);
    }

    /**
     * @return \App\Enums\PaymentMode
     */
    public static function walkIn()
    {
        return new PaymentMode(self::WALK_IN);
    }
}