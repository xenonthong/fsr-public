<?php

namespace App\Http\Controllers\Frontend;

use App\Filters\TransactionFilter;
use App\Http\Controllers\Controller;
use App\Http\RequestHandlers\CreateTransactionRequest;
use App\Http\Requests\Frontend\StoreTransaction;
use App\Models\Transaction;
use App\Notifications\TransactionCreatedByCustomer;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * @param \App\Filters\TransactionFilter $filter
     *
     * @return mixed
     */
    public function index(TransactionFilter $filter)
    {
        return Transaction::with('beneficiary')
                          ->ownedBy(Auth::id())
                          ->filter($filter)
                          ->paginate();
    }

    /**
     * @param \App\Http\Requests\Frontend\StoreTransaction $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTransaction $request)
    {
        $transaction = (new CreateTransactionRequest($request->user(), $request))->handle();
        $user        = $request->user();

        $user->notify(new TransactionCreatedByCustomer($transaction));

        return response()->json([
            'message' => 'Transaction processed.',
            'points'  => $user->points_available,
        ]);
    }

    /**
     * Show customer's beneficiary's details
     *
     * @param \App\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Transaction $transaction)
    {
        $transaction->loadMissing('beneficiary', 'media');

        return response()->json(['transaction' => $transaction]);
    }
}
