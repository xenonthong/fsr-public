<?php

namespace App\Providers;

use App\Enums\Role;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\TransactionsPerDay;
use Bakerkretzmar\SettingsTool\SettingsTool;
use Eminiarts\NovaPermissions\NovaPermissions;
use Fsr\PendingVerificationsCard\PendingVerificationsCard;
use Fsr\PendingTransactionsCard\PendingTransactionsCard;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new PendingVerificationsCard())->pendingVerifications(),
            (new PendingTransactionsCard())->pendingTransactions(),
            new TransactionsPerDay(),
            new NewUsers(),
        ];
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, ['xenonthong@gmail.com'])
                || $user->hasAnyRole([
                    (string)Role::ADMIN(),
                    (string)Role::SUPER_ADMIN(),
                ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new SettingsTool(),
            new \Bolechen\NovaActivitylog\NovaActivitylog(),
            new NovaPermissions(),
        ];
    }
}
