<?php

namespace App\Verifications;

use App\Enums\VerificationStatus;
use App\Models\Verification;
use Illuminate\Http\Request;

class AccountVerification
{
    public static function process(Request $request)
    {
        $auth = $request->user();

        // create user verification
        $verification = Verification::create([
            'user_id' => $auth->id,
            'status' => (string)VerificationStatus::PENDING()
        ]);

        // update user's verification status
        $auth->update(['verification_status' => (string)VerificationStatus::PENDING()]);

        // store assets
        $verification->addMediaFromRequest('portrait')->toMediaCollection('portrait');
        $verification->addMediaFromRequest('documentFront')->toMediaCollection('documentFront');
        $verification->addMediaFromRequest('documentRear')->toMediaCollection('documentRear');
    }
}