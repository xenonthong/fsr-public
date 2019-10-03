<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Support\Facades\Cache;

class BankController extends Controller
{
    /**
     * Get all available banks
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $banks = Cache::remember('banks', 3600, function () {
            $result = Bank::select('id', 'name')->get();

            return $result->map(function ($item) {
                return [
                    'value'   => $item->id,
                    'display' => $item->name,
                ];
            });
        });

        return response()->json(['banks' => $banks]);
    }
}
