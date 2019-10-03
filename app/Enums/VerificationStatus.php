<?php

namespace App\Enums;

use App\Enums\Traits\HasSelectOptions;
use MyCLabs\Enum\Enum;

class VerificationStatus extends Enum
{
    use HasSelectOptions;

    private const VERIFIED   = 'verified';
    private const PENDING    = 'pending';
    private const UNVERIFIED = 'unverified';
    private const FAILED     = 'failed';

    /**
     * @return \App\Enums\VerificationStatus
     */
    public static function FAILED()
    {
        return new VerificationStatus(self::FAILED);
    }

    /**
     * @return \App\Enums\VerificationStatus
     */
    public static function PENDING()
    {
        return new VerificationStatus(self::PENDING);
    }

    /**
     * @return \App\Enums\VerificationStatus
     */
    public static function UNVERIFIED()
    {
        return new VerificationStatus(self::UNVERIFIED);
    }

    /**
     * @return \App\Enums\VerificationStatus
     */
    public static function VERIFIED()
    {
        return new VerificationStatus(self::VERIFIED);
    }
}