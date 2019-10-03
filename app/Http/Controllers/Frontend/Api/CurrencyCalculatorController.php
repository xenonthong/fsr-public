<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Calculators\CurrencyCalculator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyCalculatorController extends Controller
{
    public function index(Request $request)
    {
        return (new CurrencyCalculator(
            $request->fromCurrency,
            (float)$request->fromAmount,
            $request->toCurrency)
        )->calculate();
    }
}
