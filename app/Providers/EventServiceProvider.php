<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\RestoreCartItems::class,

        ],

    ];

    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \App\Models\Cover::observe(\App\Observers\CoverObserver::class);
        \App\Models\Order::observe(\App\Observers\OrderObserver::class);
    }
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
