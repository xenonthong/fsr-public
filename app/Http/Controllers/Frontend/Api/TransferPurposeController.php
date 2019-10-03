<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Enums\FundSource;
use App\Enums\TransferPurpose;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TransferPurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Cache::remember('transfer_purposes', 7200, function () {
            return TransferPurpose::toSelectOptions();
        });

        return response()->json($sources, 200);
    }
}
