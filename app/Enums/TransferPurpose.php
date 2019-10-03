<?php

namespace App\Enums;

use App\Enums\Traits\HasSelectOptions;
use MyCLabs\Enum\Enum;

class TransferPurpose extends Enum
{
    use HasSelectOptions;

    private const INVESTMENT         = 'investment';
    private const MEDICAL_EXPENSES   = 'medical expenses';
    private const FAMILY_MAINTENANCE = 'family maintenance';
    private const PERSONAL_SAVINGS   = 'personal savings';
    private const PRODUCT_SERVICES   = 'products or services';
    private const PROPERTY           = 'property';
    private const SCHOOLING_TUITION  = 'schooling or tuition';
    private const OTHERS             = 'others';

    /**
     * @return \App\Enums\TransferPurpose
     */
    public static function familyMaintenance()
    {
        return new TransferPurpose(self::FAMILY_MAINTENANCE);
    }

    /**
     * @return \App\Enums\TransferPurpose
     */
    public static function investment()
    {
        return new TransferPurpose(self::INVESTMENT);
    }

    /**
     * @return \App\Enums\TransferPurpose
     */
    public static function medicalExpenses()
    {
        return new TransferPurpose(self::MEDICAL_EXPENSES);
    }

    /**
     * @return \App\Enums\TransferPurpose
     */
    public static function others()
    {
        return new TransferPurpose(self::OTHERS);
    }

    /**
     * @return \App\Enums\TransferPurpose
     */
    public static function personalSavings()
    {
        return new TransferPurpose(self::PERSONAL_SAVINGS);
    }

    /**
     * @return \App\Enums\TransferPurpose
     */
    public static function productServices()
    {
        return new TransferPurpose(self::PRODUCT_SERVICES);
    }

    /**
     * @return \App\Enums\TransferPurpose
     */
    public static function property()
    {
        return new TransferPurpose(self::PROPERTY);
    }

    /**
     * @return \App\Enums\TransferPurpose
     */
    public static function schoolingTuition()
    {
        return new TransferPurpose(self::SCHOOLING_TUITION);
    }
}