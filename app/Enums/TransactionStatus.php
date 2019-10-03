<?php

namespace App\Enums;

use App\Enums\Traits\HasSelectOptions;
use MyCLabs\Enum\Enum;

class TransactionStatus extends Enum
{
    use HasSelectOptions;

    private const PENDING_PAYMENT = 'pending payment';
    private const PROCESSING      = 'processing';
    private const APPROVED        = 'approved';
    private const REJECTED        = 'rejected';
    private const CREDITED        = 'credited';

    /**
     * @return \App\Enums\TransactionStatus
     */
    public static function pendingPayment()
    {
        return new TransactionStatus(self::PENDING_PAYMENT);
    }

    /**
     * @return \App\Enums\TransactionStatus
     */
    public static function approved()
    {
        return new TransactionStatus(self::APPROVED);
    }

    /**
     * @return \App\Enums\TransactionStatus
     */
    public static function credited()
    {
        return new TransactionStatus(self::CREDITED);
    }

    /**
     * @return \App\Enums\TransactionStatus
     */
    public static function processing()
    {
        return new TransactionStatus(self::PROCESSING);
    }

    /**
     * @return \App\Enums\TransactionStatus
     */
    public static function rejected()
    {
        return new TransactionStatus(self::REJECTED);
    }
}