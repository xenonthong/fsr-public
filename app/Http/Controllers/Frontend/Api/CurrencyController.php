<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Currency as CurrencyResource;
use App\Models\Currency;
use Illuminate\Support\Facades\Cache;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies =  Cache::remember('currencies', 7200, function () {
           return CurrencyResource::collection(Currency::all());
        });

        return response()->json($currencies, 200);
    }
}
