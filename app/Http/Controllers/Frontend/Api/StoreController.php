<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Store as StoreResource;
use App\Models\Store;
use Illuminate\Support\Facades\Cache;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores =  Cache::remember('stores', 7200, function () {
           return StoreResource::collection(Store::all());
        });

        return response()->json($stores, 200);
    }
}
