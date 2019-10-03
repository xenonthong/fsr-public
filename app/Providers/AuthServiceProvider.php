<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Address::class                  => \App\Policies\AddressPolicy::class,
        \App\Models\Point::class                    => \App\Policies\PointPolicy::class,
        \App\Models\Verification::class             => \App\Policies\VerificationPolicy::class,
        \App\Models\Bank::class                     => \App\Policies\BankPolicy::class,
        \App\Models\Store::class                    => \App\Policies\StorePolicy::class,
        \App\Models\Transaction::class              => \App\Policies\TransactionPolicy::class,
        \Spatie\Permission\Models\Permission::class => \App\Policies\PermissionPolicy::class,
        \Spatie\Permission\Models\Role::class       => \App\Policies\RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
