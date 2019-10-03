<?php

namespace App\Calculators;

use App\Enums\FeeType;
use App\Helpers\Formatter;
use App\Http\Resources\Currency as CurrencyResource;
use App\Models\Currency;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CurrencyCalculator
{
    /**
     * @var mixed
     */
    protected $currencies;

    /**
     * @var string
     */
    protected $fromCurrency;

    /**
     * @var float
     */
    protected $fromAmount;

    /**
     * @var string
     */
    protected $toCurrency;

    /**
     * CurrencyCalculator constructor.
     *
     * @param string $fromCurrency
     * @param float  $fromAmount
     * @param string $toCurrency
     */
    public function __construct(string $fromCurrency, float $fromAmount, string $toCurrency)
    {
        $this->fromCurrency = strtoupper($fromCurrency);
        $this->fromAmount   = $fromAmount;
        $this->toCurrency   = strtoupper($toCurrency);
        $this->currencies   = $this->getCurrencies();
    }

    public function calculate()
    {
        $currency = $this->getConvertibleCurrency();

        if ($this->fromCurrency === $this->toCurrency) {
            return [
                'amount' => Formatter::money($this->fromAmount),
                'fees'   => Formatter::money($this->getFeeAmount($currency->fees)),
            ];
        }

        return [
            'amount' => Formatter::money($this->getConversionAmount($currency->rates)),
            'fees'   => Formatter::money($this->getFeeAmount($currency->fees)),
        ];
    }

    /**
     * Get the converted amount using rates from the
     * currency we are converting to.
     *
     * @param array $rates
     *
     * @return float|int
     */
    protected function getConversionAmount(array $rates)
    {
        $matching = Arr::first($rates, function ($rate) {
            return $rate['attributes']['code'] === $this->fromCurrency;
        });

        return $this->fromAmount / $matching['attributes']['conversion'];
    }

    /**
     * Get the currency we're trying to convert to.
     *
     * @return mixed
     */
    protected function getConvertibleCurrency()
    {
        return $this->currencies
            ->collection
            ->where('code', $this->toCurrency)
            ->first();
    }

    /**
     * Get available currencies from our cache or DB.
     *
     * @return mixed
     */
    protected function getCurrencies()
    {
        return Cache::remember('currencies', 7200, function () {
            return CurrencyResource::collection(Currency::all());
        });
    }

    /**
     * Get the fees using fromAmount.
     *
     * @param array $fees
     *
     * @return float|int
     */
    protected function getFeeAmount(array $fees)
    {
        $matching = Arr::first($fees, function ($fee) {
            return $fee['attributes']['min'] <= $this->fromAmount && $fee['attributes']['max'] >= $this->fromAmount;
        });

        if (!$matching) return 0;

        switch ($matching['attributes']['type']) {
            case (string)FeeType::fixed():
                return (float)$matching['attributes']['amount'];
                break;
            case (string)FeeType::percent():
                return $matching['attributes']['amount'] / 100 * $this->fromAmount;
                break;
            default:
                return 0;
        }
    }
}