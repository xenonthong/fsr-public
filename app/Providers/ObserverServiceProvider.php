<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\Verification;
use App\Observers\TransactionObserver;
use App\Observers\VerificationObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Verification::observe(VerificationObserver::class);
        Transaction::observe(TransactionObserver::class);
    }
}
