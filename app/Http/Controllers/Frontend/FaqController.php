<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Cache;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Cache::remember('faqs', 3600, function () {
            return Faq::all();
        });

        return response()->json(['faqs' => $faqs]);
    }
}
