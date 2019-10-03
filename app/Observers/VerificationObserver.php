<?php

namespace App\Observers;

use App\Enums\VerificationStatus;
use App\Models\Verification;
use App\Notifications\AccountVerified;

class VerificationObserver
{
    /**
     * Handle the verification "updated" event.
     *
     * @param  \App\Models\Verification  $verification
     * @return void
     */
    public function updated(Verification $verification)
    {
        if ($verification->isDirty('status')) {
            switch ($verification->status) {
                case (string) VerificationStatus::VERIFIED():
                    $verification->user->verification_status = (string) VerificationStatus::VERIFIED();
                    $verification->user->save();
                    $verification->user->notify(new AccountVerified());
                    break;

                case (string) VerificationStatus::FAILED():
                    $verification->user->verification_status = (string) VerificationStatus::FAILED();
                    $verification->user->save();
                    break;
            }
        }
    }
}
