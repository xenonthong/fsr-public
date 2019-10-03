<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\VerificationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreVerificationRequest;
use App\Models\Verification;
use App\Verifications\AccountVerification;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function store(StoreVerificationRequest $request)
    {
        $pending = Verification::where('user_id', Auth::id())
                               ->where('status', (string)VerificationStatus::PENDING())
                               ->exists();

        if ($pending) return response()->json('A pending verification is waiting for response.');

        try {
            AccountVerification::process($request);
        }
        catch (\Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
        //
        return response()->json('Verification request submitted.');
    }
}
