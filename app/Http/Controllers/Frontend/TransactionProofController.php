<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TransactionStatus;
use App\Filters\TransactionFilter;
use App\Http\Controllers\Controller;
use App\Http\RequestHandlers\CreateTransactionRequest;
use App\Http\Requests\Frontend\StoreTransaction;
use App\Http\Requests\Frontend\StoreTransactionProof;
use App\Models\Transaction;
use App\Notifications\TransactionCreatedByCustomer;
use Illuminate\Support\Facades\Auth;

class TransactionProofController extends Controller
{
    /**
     * @param \App\Models\Transaction                           $transaction
     * @param \App\Http\Requests\Frontend\StoreTransactionProof $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Transaction $transaction, StoreTransactionProof $request)
    {
        try {
            $transaction->addMediaFromRequest('proof')->toMediaCollection('proof');
        }
        catch (\Exception $exception) {
            return response()->json(['errors' => [$exception->getMessage()]], $exception->getCode());
        }

        $transaction->update(['status' => (string) TransactionStatus::processing()]);

        return response()->json('Your proof of payment has been uploaded.');
    }
}
