<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Support\Facades\Cache;

class LatestPromotionController extends Controller
{
    /**
     * Show latest ongoing promotion.
     *
     * @return void
     */
    public function show()
    {
        $promo = Cache::remember('promotion', 7200, function () {
            return Promotion::ongoing()->latest()->first();
        });

        return response()->json(['promotion' => $promo]);
    }
}
