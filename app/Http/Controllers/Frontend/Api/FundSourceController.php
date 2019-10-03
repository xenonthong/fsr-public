<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Enums\FundSource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class FundSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Cache::remember('fund_sources', 7200, function () {
            return FundSource::toSelectOptions();
        });

        return response()->json($sources, 200);
    }
}
