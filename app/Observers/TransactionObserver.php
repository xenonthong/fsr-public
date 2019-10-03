<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Point;
use App\Notifications\TransactionCredited;
use App\Notifications\TransactionRequestRejected;
use Carbon\Carbon;

class TransactionObserver
{

    /**
     * Handle the transaction "updated" event.
     *
     * @param \App\Models\Transaction $transaction
     *
     * @return void
     * @throws \Exception
     */
    public function updated(Transaction $transaction)
    {
        if ($transaction->isDirty('status')) {
            if ($transaction->isCredited()) {
                $transaction->user->notify(new TransactionCredited);

                if ($transaction->isUserOnlyTransaction()) {
                    Point::create([
                        'awarded'    => 100,
                        'expires_at' => (new Carbon())->addMonths(2),
                        'user_id' => $transaction->user->referrer->id
                    ]);
                }
            }

            if ($transaction->isApproved()) {
                $transaction->user->notify(new TransactionApproved);
            }

            if ($transaction->isRejected()) {
                $transaction->user->notify(new TransactionRejected($transaction));
            }
        }
    }
}
