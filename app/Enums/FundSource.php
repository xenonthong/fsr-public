<?php

namespace App\Enums;

use App\Enums\Traits\HasSelectOptions;
use MyCLabs\Enum\Enum;

class FundSource extends Enum
{
    use HasSelectOptions;

    private const BORROWING        = 'borrowing';
    private const BUSINESS_PROFIT  = 'business profit';
    private const PERSONAL_SAVINGS = 'personal savings';
    private const RETIREMENT_FUND  = 'retirement fund';
    private const SALARY           = 'salary or wage';
    private const SAVING_ACCOUNT   = 'saving account';
    private const THIRD_PARTY      = 'third party';
    private const OTHERS           = 'others';

    /**
     * @return \App\Enums\FundSource
     */
    public static function borrowing()
    {
        return new FundSource(self::BORROWING);
    }

    /**
     * @return \App\Enums\FundSource
     */
    public static function businessProfit()
    {
        return new FundSource(self::BUSINESS_PROFIT);
    }

    /**
     * @return \App\Enums\FundSource
     */
    public static function others()
    {
        return new FundSource(self::OTHERS);
    }

    /**
     * @return \App\Enums\FundSource
     */
    public static function personalSavings()
    {
        return new FundSource(self::PERSONAL_SAVINGS);
    }

    /**
     * @return \App\Enums\FundSource
     */
    public static function retirementFund()
    {
        return new FundSource(self::RETIREMENT_FUND);
    }

    /**
     * @return \App\Enums\FundSource
     */
    public static function salary()
    {
        return new FundSource(self::SALARY);
    }

    /**
     * @return \App\Enums\FundSource
     */
    public static function savingAccount()
    {
        return new FundSource(self::SAVING_ACCOUNT);
    }

    /**
     * @return \App\Enums\FundSource
     */
    public static function thirdParty()
    {
        return new FundSource(self::THIRD_PARTY);
    }
}