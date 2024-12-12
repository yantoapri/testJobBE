<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\ModulPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access', [ModulPolicy::class, 'view']);
        Gate::define('create', [ModulPolicy::class, 'create']);
        Gate::define('update', [ModulPolicy::class, 'update']);
        Gate::define('delete', [ModulPolicy::class, 'delete']);
    }
}
